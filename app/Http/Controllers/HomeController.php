<?php

namespace App\Http\Controllers;

use App\Labour;
use App\Attendence;
use App\LabourTransection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function sss()
    {
        echo Auth::user()->role;
    }

    public function updateAttendence(Request $request){
        for ($i=0; $i < count($request->attendence_id) ; $i++) {

            $labour=Labour::find($request->labour_id[$i]);
            $payable_money=($labour->wages/2) * ((int)$request->first[$i]+(int)$request->secound[$i]+(int)$request->third[$i]+(int)$request->fourth[$i]);

            $update=Attendence::find($request->attendence_id[$i])->update([
                'first' => $request->first[$i],
                'secound' => $request->secound[$i],
                'third' => $request->third[$i],
                'fourth' => $request->fourth[$i],
                'payable_money' =>$payable_money,
                'paid'=>$request->paid[$i],
                'note' => $request->note[$i],
            ]);
            if ($request->paid[$i]>0) {
                $data=array(
                    'labour_id' =>$request->labour_id[$i],
                    'project_id' => $request->project_id,
                    'amount' =>$request->paid[$i],
                    'date' =>date('Y-m-d'),
                    'given_by' => Auth::user()->id,
                );

                $transection=LabourTransection::create($data);
            }
            
        }
        if ($update) {
                $notification=array(
                    'message'=>'Attendence Updated!!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'message'=>'Opps!! Somthing wrong!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
        }
    }
}
