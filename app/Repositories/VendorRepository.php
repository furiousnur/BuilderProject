<?php 

namespace App\Repositories;

use App\Vendor;


class VendorRepository implements VendorRepositoryInterface{


	public function index(){
 		return Vendor::all();
 	}

 	public function show($id){
 		return Vendor::find($id);
 	}

 	public function store(array $data){
 		return Vendor::create($data);
 	}

 	public function edit($id){
 		return Vendor::find($id);
 	}

 	public function update(array $data, $id){
 		return Vendor::find($id)->update($data);
 	}

 	public function delete($id){
 		return Vendor::destroy($id);
 	}
}