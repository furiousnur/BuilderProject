<?php 
namespace App\Repositories;

use App\Labour;
use App\Attendence;
use App\LabourTransection;
/**
 * 
 */
class LabourRepository implements LabourRepositoryInterface
{
			
 	public function index(){
 		return Labour::all();
 	}

 	public function show($id){
 		return Labour::find($id);
 	}

 	public function store(array $data){
 		return Labour::create($data);
 	}

 	public function edit($id){
 		return Labour::find($id);
 	}

 	public function update(array $data, $id){
 		return Labour::find($id)->update($data);
 	}

 	public function delete($id){
 		return Labour::destroy($id);
 	}

 	public function count(){
 		return Labour::count();
 	}

 	public function storeTransection(array $data){
 		return LabourTransection::create($data);
 	}

 	public function transectionHistory($id){
 		return LabourTransection::where('labour_id',$id)->get();
 	}

 	public function totalPayableMoney($id){
 		return Attendence::where('labour_id',$id)->sum('payable_money');
 	}

 	public function paid($id){
 		return LabourTransection::where('labour_id',$id)->sum('amount');
 	}


 	public function due($id){
 		return $this->totalPayableMoney($id)-$this->paid($id);
 	}



}
