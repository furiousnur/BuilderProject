<?php

namespace App\Http\Controllers;

use Calendar;
use App\Labour;
use App\Manager;
use App\Project;
use App\LabourTransection;
use App\ManagerTransection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Repositories\LabourRepositoryInterface;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\AttendenceRepositoryInterface;

class LabourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $labour;
    protected $project;
    protected $attendence;

    public function __construct(LabourRepositoryInterface $labour,ProjectRepositoryInterface $project,AttendenceRepositoryInterface $attendence){
        $this->labour=$labour;
        $this->project=$project;
        $this->attendence=$attendence;
    }

    public function index()
    {
        if (Auth::user()->role==1) {
            $projects=$this->project->index();
            $count=$this->project->count();
            $manCount=$this->labour->count();
            return view('admin.manpower.index',compact('projects','count','manCount'));
        }else{
            $manager=Manager::where('user_id',Auth::user()->id)->first();
            $project=Project::find($manager->project_id);
            return view('admin.manpower.index',compact('project'));
        }
        
    }


    public function create()
    {
        if (Auth::user()->role==1) {
            $projects=$this->project->index();
            return view('admin.manpower.create',compact('projects'));
        }else{
            $manager=Manager::where('user_id',Auth::user()->id)->first();
            $projects=Project::where('id',$manager->project_id)->get();
            return view('admin.manpower.create',compact('projects'));
        }
        
    }


    public function store(Request $request)
    {
        try {
            $validator =Validator::make($request->all(), [
            'name' => 'required',
            'father_name' => 'required',
            'phone' => 'required',
            'project_id' => 'required',
            'designation' => 'required',
            ]);
            if ($validator->fails()) {
                $notification=array(
                'message'=>'Insert all required field correctly!',
                'alert-type' => 'error'
                );
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $imageName=NULL;
            if ($request->file('image')) {
                $image=$request->file('image');
                $ext=$image->getClientOriginalExtension();
                $imageName=str_random(20).".".$ext;
                $move=$image->move(public_path('images/labour-image/'),$imageName);
            }
            $data=$request->all();
            $data['image']=$imageName;
            $this->labour->store($data);
            $notification=array(
                'message'=>'Successfully added one person!',
                'alert-type' => 'success',
                );
                return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            $err_msg=\Lang::get($e->getMessage());
            $notification=array(
                'message'=>$err_msg,
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification)->withInput();
        }
        
    }


    public function show($id)
    {
        $labour=$this->labour->show($id);
        $payableMoney=$this->labour->totalPayableMoney($id);
        $due=$this->labour->due($id);
        $paid=$this->labour->paid($id);
        $transections=$this->labour->transectionHistory($id);

        $events = [];
        $data = $this->attendence->search('labour_id',$id);
        if($data->count()) {
            foreach ($data as $key => $attendence) {
                $shift=(int)$attendence->first+(int)$attendence->secound+(int)$attendence->third+(int)$attendence->fourth;
                if ($shift > 0) {
                    $events[] = Calendar::event(
                    (string)$shift." shift",
                    true,
                    new \DateTime($attendence->date),
                    new \DateTime($attendence->date),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#f05050',
                        'url' => '#',
                    ]
                );
                }
                
            }
        }
        $calendar = Calendar::addEvents($events);
        // return view('fullcalender', compact('calendar'));


        return view('admin.manpower.single-details',compact('labour','payableMoney','due','paid','transections','calendar'));
    }


    public function labourSearchAjax(Request $request){
        $project=$this->project->show($request->pid);
        
        return view('admin.manpower.ajax-labours-list',compact('project'));
    }

    public function labourAttendenceAjax(Request $request){
        
        $project=$this->project->show($request->pid);
        
        return view('admin.manpower.ajax-labours-attendence',compact('project'));
    }

    public function transection(Request $request){

        if (Auth::user()->role!=3) {
            $notification=array(
                    'message'=>'You have to be a manager to pay manpower money!',
                    'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

        try {

            $validator=validator()->make(request()->all(),[
            'labour_id' => 'required',
            'project_id' => 'required',
            'amount' => 'required | digits_between:1,10',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }else{

                $availity=(ManagerTransection::where('manager_id',Auth::user()->id)->sum('amount'))-(LabourTransection::where('given_by',Auth::user()->id)->sum('amount'));

                if ($availity<$request->amount) {
                    $notification=array(
                            'message'=>'Insufficient Balance!',
                            'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }

                $data=$request->all();
                $insert=$this->labour->storeTransection($data);

                $notification=array(
                    'message'=>'Payment Successfully Done!!',
                    'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
            }
        }

        catch (\Exception $e) {
            $err_msg=\Lang::get($e->getMessage());
            $notification = array(
                'message' => $err_msg,
                'alert-type'=>'error',
            );
            return redirect()->back()->with($notification);
        }
        
    }
}
