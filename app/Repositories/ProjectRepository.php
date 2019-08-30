<?php
 namespace App\Repositories;

 use App\Project;

 class ProjectRepository implements ProjectRepositoryInterface
 {
 		
 	public function index(){
 		return Project::all();
 	}

 	public function show($id){
 		return Project::find($id);
 	}

 	public function store(array $data){
 		return Project::create($data);
 	}

 	public function edit($id){
 		return Project::find($id);
 	}

 	public function update(array $data, $id){
 		return Project::find($id)->update($data);
 	}

 	public function delete($id){
 		return Project::destroy($id);
 	}

 	public function projectTotal(){
 		return Project::sum('price');
 	}

 	public function count(){
 		return Project::count();
 	}
 }