<?php

namespace App\Http\Controllers;

use Auth;
use App\Labour;
use App\Project;
use App\Attendence;
use Illuminate\Http\Request;
use App\Repositories\LabourRepositoryInterface;
use App\Repositories\AttendenceRepositoryInterface;

class AttendenceController extends Controller
{
    protected $attendence;
    protected $labour;

    public function __construct(AttendenceRepositoryInterface $attendence, LabourRepositoryInterface $labour){
        $this->attendence=$attendence;
        $this->labour=$labour;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


            $pastAtten=Attendence::where('date',$request->date)->get();
            
            if (count($pastAtten)>0) {
                $row=Attendence::where('date',$request->date)->first();
                $count=$row->count;
            }else{
                $count=0;
            }

            if (date('Y-m-d')<$request->date || date('Y-m-d')>$request->date) {
                $notification=array(
                    'message'=>"Only Current date is allowed!",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

            if ($count>=4) {
                $notification=array(
                    'message'=>"Attendence Already Taken!!",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

            $firstShift=070000;
            $secoundShift=170000;
            $thirdShift=070000;
            $fourthShift=070000;
            $end=070000;
            $time=(int) date("His");

            // echo $time; die;

            if ($count==0 && $time>=$firstShift && $time<$secoundShift) {
                for ($i=0; $i < count($request->labour_id) ; $i++) {
                    $labour=$this->labour->show($request->labour_id[$i]);
                    if ($request->first[$i]>0) {
                        $payable_money=($labour->wages/2) * 1;
                    }else{
                        $payable_money=0;
                    }
                    
                    $data= array(
                        'project_id'=>$request->project_id,
                        'labour_id' => $request->labour_id[$i],
                        'first' => $request->first[$i],
                        'secound' => 0,
                        'third' => 0,
                        'fourth' => 0,
                        'date' =>$request->date,
                        'payable_money' =>$payable_money,
                        'paid'=>$request->paid[$i],
                        'note' => $request->note[$i],
                        'count' => 1,
                    );
                    $store=$this->attendence->store($data);
                    if ($request->paid[$i]>0) {
                        $data=array(
                            'labour_id' =>$request->labour_id[$i],
                            'project_id' => $request->project_id,
                            'amount' =>$request->paid[$i],
                            'date' =>$store->created_at->format('Y-m-d'),
                            'given_by' => Auth::user()->id,
                        );

                        $transection=$this->labour->storeTransection($data);
                    }
                }
                $notification=array(
                    'message'=>"First Shift Attendence Take Successful",
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);

            }elseif ($count==1 && $time>=$secoundShift && $time<$thirdShift) {
                for ($i=0; $i < count($pastAtten) ; $i++) {

                    $labour=Labour::find($request->labour_id[$i]);
                    $payable_money=(($labour->wages/2) * ($pastAtten[$i]->first+$request->first[$i]));

                    $update=Attendence::find($pastAtten[$i]->id)->update([
                        'secound' => $request->first[$i],
                        'payable_money' =>$payable_money,
                        'paid'=>($request->paid[$i]+$pastAtten[$i]->paid),
                        'note' => $request->note[$i],
                        'count' => 2,
                    ]);

                    if ($request->paid[$i]>0) {
                        $data=array(
                            'labour_id' =>$request->labour_id[$i],
                            'project_id' => $request->project_id,
                            'amount' =>$request->paid[$i],
                            'date' =>date('Y-m-d'),
                            'given_by' => Auth::user()->id,
                        );

                        $transection=$this->labour->storeTransection($data);
                    }
                    $notification=array(
                        'message'=>"Secound Shift Attendence Take Successful",
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                    
                }
            }
            elseif ($count==2 && $time>=$thirdShift && $time<$fourthShift) {
                for ($i=0; $i < count($pastAtten) ; $i++) {

                    $labour=Labour::find($request->labour_id[$i]);
                    $payable_money=(($labour->wages/2) * ($pastAtten[$i]->first+$pastAtten[$i]->secound+$request->first[$i]));

                    $update=Attendence::find($pastAtten[$i]->id)->update([
                        'third' => $request->first[$i],
                        'payable_money' =>$payable_money,
                        'paid'=>($request->paid[$i]+$pastAtten[$i]->paid),
                        'note' => $request->note[$i],
                        'count' => 3,
                    ]);

                    if ($request->paid[$i]>0) {
                        $data=array(
                            'labour_id' =>$request->labour_id[$i],
                            'project_id' => $request->project_id,
                            'amount' =>$request->paid[$i],
                            'date' =>date('Y-m-d'),
                            'given_by' => Auth::user()->id,
                        );

                        $transection=$this->labour->storeTransection($data);
                    }
                    $notification=array(
                        'message'=>"Third Shift Attendence Take Successful",
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                    
                }
            }elseif ($count==3 && $time>=$fourthShift && $time<$end) {
                for ($i=0; $i < count($pastAtten) ; $i++) {

                    $labour=Labour::find($request->labour_id[$i]);
                    $payable_money=(($labour->wages/2) * ($pastAtten[$i]->first+$pastAtten[$i]->secound+$pastAtten[$i]->third+$request->first[$i]));

                    $update=Attendence::find($pastAtten[$i]->id)->update([
                        'third' => $request->first[$i],
                        'payable_money' =>$payable_money,
                        'paid'=>($request->paid[$i]+$pastAtten[$i]->paid),
                        'note' => $request->note[$i],
                        'count' => 4,
                    ]);

                    if ($request->paid[$i]>0) {
                        $data=array(
                            'labour_id' =>$request->labour_id[$i],
                            'project_id' => $request->project_id,
                            'amount' =>$request->paid[$i],
                            'date' =>date('Y-m-d'),
                            'given_by' => Auth::user()->id,
                        );

                        $transection=$this->labour->storeTransection($data);
                    }
                    $notification=array(
                        'message'=>"Fourth Shift Attendence Take Successful",
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                    
                }
            }
            else{
                $notification=array(
                    'message'=>"Opps! Shift Not Open Yet!",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
            
            
            

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function show(Attendence $attendence)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */

    

    public function edit(Attendence $attendence)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendence $attendence)
    {
        //
    }

    public function editSearch(){
        $projects=Project::all();
        return view('admin.manpower.attendence-search',compact('projects'));
    }



    public function editForm(Request $request){
        $date=$request->date;
        $project=Project::find($request->project_id);
        $attendence=Attendence::where('project_id',$request->project_id)->where('date',$request->date)->get();

        return view('admin.manpower.attendence-update',compact('attendence','project','date'));
    }

    public function updateAttendence(Request $request){
        
        
    }
}
