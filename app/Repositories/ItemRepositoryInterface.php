<?php 
 namespace App\Repositories;

 interface ItemRepositoryInterface{
 	public function index();
 	public function show($id);
 	public function store(array $data);
 	public function edit($id);
 	public function update(array $data, $id);
 	public function delete($id);
 }