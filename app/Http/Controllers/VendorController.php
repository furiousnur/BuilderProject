<?php
// violate repository stracture
namespace App\Http\Controllers;

use App\Bank;
use App\Vendor;
use App\Manager;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\VendorRepositoryInterface;

class VendorController extends Controller
{

    protected $vendor;

    public function __construct(VendorRepositoryInterface $vendor){
        $this->vendor = $vendor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role==1) {
            $vendors=$this->vendor->index();
            $banks=Bank::all();
            return view('admin.vendor.index',compact('vendors','banks'));
        }else{
            $manager=manager::where('user_id',Auth::user()->id)->first();
            $projects=Project::where('id',$manager->project_id)->pluck('id');
            $vendors=Vendor::whereIn('project_id',$projects)->get();
            $banks=Bank::all();
            return view('admin.vendor.index',compact('vendors','banks'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role==1) {
            $projects=Project::all();
            return view('admin.vendor.create',compact('projects'));
        }else{
            $manager=manager::where('user_id',Auth::user()->id)->first();
            $projects=Project::where('id',$manager->project_id)->get();
            return view('admin.vendor.create',compact('projects'));
        }
        
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
            'name'=> 'required',
            'project_id' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $data=$request->all();
        $insert = $this->vendor->store($data);

        if ($insert) {
            $notification=array(
                'message' => 'Vendor Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('vendor.create')->with($notification);
        }else{
            $notification=array(
                'message' => 'Oops! Somthing went wrong!',
                'alert-type' => 'danger'
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        $banks=Bank::all();
        return view('admin.vendor.details',compact('vendor','banks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
