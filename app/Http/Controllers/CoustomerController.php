<?php

namespace App\Http\Controllers;

use App\Project;
use App\Coustomer;
use Illuminate\Http\Request;

class CoustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coustomers=Coustomer::all();
        return view('admin.coustomer.index',compact('coustomers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects=Project::all();
        return view('admin.coustomer.create',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate= validator()->make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'address' =>'required',
        ]);

        if ($validate->fails()) {
            $notification=array(
                'message' => 'Please Input field properly!',
                'alert-type' =>'error'
            );
            return redirect()->back()->withInput()->withErrors($validate)->with($notification);
        }

        $create=Coustomer::create($request->all());

        if ($create) {
            $notification = array(
                'message' => 'Item Added successful!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coustomer  $coustomer
     * @return \Illuminate\Http\Response
     */
    public function show(Coustomer $coustomer)
    {
        return view('admin.coustomer.show',compact('coustomer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coustomer  $coustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(Coustomer $coustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coustomer  $coustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coustomer $coustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coustomer  $coustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coustomer $coustomer)
    {
        //
    }
}
