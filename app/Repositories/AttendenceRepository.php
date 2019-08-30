<?php
 namespace App\Repositories;

 use App\Attendence;

 class AttendenceRepository implements AttendenceRepositoryInterface
 {
 		
 	public function index(){
 		return Attendence::all();
 	}

 	public function show($id){
 		return Attendence::find($id);
 	}

 	public function store(array $data){
 		return Attendence::create($data);
 	}

 	public function edit($id){
 		return Attendence::find($id);
 	}

 	public function update(array $data, $id){
 		return Attendence::find($id)->update($data);
 	}

 	public function delete($id){
 		return Attendence::destroy($id);
 	}

 	public function search($column,$key){
 		return Attendence::where($column,$key)->get();
 	}

 }