<?php

namespace App\Http\Controllers;

use App\Labour;
use App\Manager;
use App\Project;
use App\Attendence;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\AttendenceRepositoryInterface;
use App\Repositories\ManpowerReportRepositoryInterface;

class ManpowerReportController extends Controller
{

    protected $manReport;
    protected $project;
    protected $attendence;

    public function __construct(ManpowerReportRepositoryInterface $manReport,ProjectRepositoryInterface $project,AttendenceRepositoryInterface $attendence){
        $this->manReport = $manReport;
        $this->project = $project;
        $this->attendence = $attendence;
    }

    public function index()
    {
        if (Auth::user()->role==1) {
            $projects=$this->project->index();
            return view('admin.manpower.report.index',compact('projects'));
        }else{
            $manager=Manager::where('user_id',Auth::user()->id)->first();
            $projects=Project::where('id',$manager->project_id)->get();
            return view('admin.manpower.report.index',compact('projects'));
        }
        
    }

    public function searchAttendence(Request $request){
        $attendence=$this->manReport->searchAttendence($request->pid,$request->date);
        $date=$request->date;
        $project=$this->project->show($request->pid);
        return view('admin.manpower.report.ajax-attendence',compact('attendence','date','project'));
    }

    public function monthlypdf(Request $request,$id){


        $data=Labour::find($id);
        $data['start']=$request->start;
        $data['end']=$request->end;

        $att=Attendence::where('labour_id',$id)->whereBetween('date',[$request->start,$request->end])->get();


        $pdf = PDF::loadView('admin.manpower.report.monthlypdf', compact('data','att'));
        return $pdf->stream('invoice.pdf');
    }

}
