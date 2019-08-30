<?php 

namespace App\Repositories;

use App\Attendence;

class ManpowerReportRepository implements ManpowerReportRepositoryInterface{


	public function searchAttendence($project,$date){
		return Attendence::where('project_id',$project)->where('date',$date)->get();
	}


}