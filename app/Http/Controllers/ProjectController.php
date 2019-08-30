<?php

namespace App\Http\Controllers;

use App\BankRecharge;
use App\Coustomer;
use App\ItemTransection;
use App\Manager;
use App\ManagerTransection;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProjectRepositoryInterface;

class ProjectController extends Controller
{

    protected $project;

    public function __construct(ProjectRepositoryInterface $project){
        $this->project= $project;
    }



    public function index()
    {

        if (Auth::user()->role==1) {
            $projects=$this->project->index();
            return view('admin.project.lists')->with('projects',$projects);
        }else{
            $manager=Manager::where('user_id',Auth::user()->id)->first();
            $projects=Project::find($manager->project_id);
            return view('admin.project.lists')->with('projects',$projects);
        }
        
    }

    public function show ($id)
    {
        $project = Project::find($id);
        $itemId=$project->items->pluck ('item_id');
        $projectExpItem=ItemTransection::whereIn ('item_id',$itemId)->get ();
        $manager=Manager::where('project_id',$project->id)->first();

        $coustomers = $project->coustomers->pluck ('id');
        $income= BankRecharge::whereIn ('coustomer_id',$coustomers)->get ();

        $projectExpManpower = ManagerTransection::where ('manager_id',$manager->user_id)->where ('type','CREDIT')->get ();
        return view('admin.project.show',compact('project','projectExpManpower','projectExpItem','income'));
    }



    public function store(Request $request)
    {

        try {
            $data=$request->all();
            $create=$this->project->store($data);
            // $projects=$this->project->index();
            if ($create) {
                $notification = array(
                    'message' => 'Project Successfully Created! ', 
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }

        } 

        catch (\Exception $e) {
            $err_msg = \Lang::get($e->getMessage());
            $notification = array(
                'message' => $err_msg, 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

    
    }


}
