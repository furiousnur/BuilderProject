<?php

namespace App\Http\Controllers;

use App\ItemName;
use Illuminate\Http\Request;

class ItemNameController extends Controller
{
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
        return view('admin.inventory.item-name-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator()->make($request->all(),[
            'name'=> 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $insert=ItemName::create([
            'name' => $request->name,
        ]);

        if ($insert) {
            $notification=array(
                'message' => 'Item Name Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message' => 'Oops! Somthing went wrong!',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemName  $itemName
     * @return \Illuminate\Http\Response
     */
    public function show(ItemName $itemName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemName  $itemName
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemName=ItemName::find($id);
        return view('admin.inventory.item-name-edit',compact('itemName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemName  $itemName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $itemName=ItemName::find($id);
        $update=$itemName->update([
            'name' => $request->name,
        ]);

        if ($update) {
            $notification=array(
                'message' => 'Item Name Successfully updated!',
                'alert-type' => 'success'
            );
            return redirect()->route('item.create')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemName  $itemName
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemName $itemName)
    {
        //
    }

    public function delete($id){
        $delete = ItemName::destroy($id);

        $notification = array(
                'message' => 'Delete Successful', 
                'alert-type' => 'success'
            );

        return redirect()->back()->with($notification);
    }
}
