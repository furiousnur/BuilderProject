<?php 

namespace App\Repositories;

use App\Item;
use App\ItemLog;


class ItemRepository implements ItemRepositoryInterface{


	public function index(){
 		return Item::all();
 	}

 	public function show($id){
 		return Item::find($id);
 	}

 	public function store(array $data){
 		return Item::create($data);
 	}

 	public function edit($id){
 		return Item::find($id);
 	}

 	public function update(array $data, $id){
 		return Item::find($id)->update($data);
 	}

 	public function delete($id){
 		return Item::destroy($id);
 	}







 	public function log_index(){
 		return ItemLog::all();
 	}

 	public function log_show($id){
 		return ItemLog::find($id);
 	}

 	public function log_store(array $data){
 		return ItemLog::create($data);
 	}

 	public function log_edit($id){
 		return ItemLog::find($id);
 	}

 	public function log_update(array $data, $id){
 		return ItemLog::find($id)->update($data);
 	}

 	public function log_delete($id){
 		return ItemLog::destroy($id);
 	}
}