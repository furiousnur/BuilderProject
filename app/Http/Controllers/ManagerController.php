<?php

namespace App\Http\Controllers;

use Auth;
use App\Bank;
use App\User;
use App\Manager;
use App\Project;
use App\BankRecharge;
use App\LabourTransection;
use App\ManagerTransection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers=Manager::all();
        return view('admin.manager.index',compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects=Project::all();
        return view('admin.manager.create',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' =>'required',
            'project_id'=>'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            $notification=array(
                'message'=>'Insert all required field correctly!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $create=User::create([
            'name' => $request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>Hash::make($request['password']),
            'role' => 3,
        ]);

        $manager=Manager::create([
            'user_id' => $create->id,
            'project_id'=>$request->project_id,
        ]);

        if ($create && $manager) {
            $notification=array(
                'message'=>'Created!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function managerDetails($id){
        $manager=Manager::where('user_id',$id)->first();
        $todayy=date('Y-m-d H:i:s');
        $lastSevenDay=\Carbon\Carbon::today()->subDays(7);
        $transections=LabourTransection::where('given_by',$id)->where('created_at','>=',$lastSevenDay)->where('created_at','<=',$todayy)->get();
        $recive=ManagerTransection::where('manager_id',$id)->where('type','CREDIT')->get();
        $vendorTransection=ManagerTransection::where('type','DEBIT')->where('manager_id',$id)->get();
        return view('admin.manager.show',compact('transections','manager','recive','vendorTransection'));

        
    }


    public function show($id)
    {
        if (Auth::user()->role==3) {
            if (Auth::user()->id != $id) {
                $notification=array(
                    'message'=>'Invalid Request!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }else{
                return $this->managerDetails($id);
            }
        }else{
            return $this->managerDetails($id);
        }
        
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        //
    }

    public function rechageStore(Request $request){
        $validator=Validator::make($request->all(), [
            'amount' => ['required', 'string', 'max:255'],
            'bank_id' =>'required',
            'manager_id'=>'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            $notification=array(
                'message'=>'Insert all required field correctly!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $bank=Bank::find($request->bank_id);
        $balanceAvailttyCheck=$bank->recharges->where('type','CREDIT')->sum('amount')-$bank->recharges->where('type','DEBIT')->sum('amount');

        if ($balanceAvailttyCheck<$request->amount) {
            $notification=array(
                'message'=>'Low Balance in account!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $lastBalance=BankRecharge::orderBy('created_at','DESC')->first();
        $debitableBalance=$lastBalance->balance-$request->amount;

        $create=BankRecharge::create([
            'bank_id' => $request->bank_id,
            'manager_id' => $request->manager_id,
            'amount'=>$request->amount,
            'date'=>$request->date,
            'note'=>$request->note,
            'balance'=>$debitableBalance,
            'type'=>'DEBIT',
        ]);

        $createManagerTransection=ManagerTransection::create([
            'manager_id' =>$request->manager_id,
            'bank_id' =>$request->bank_id,
            'amount' =>$request->amount,
            'type' =>'CREDIT',
        ]);

        if ($create || $createManagerTransection) {
            $notification=array(
                'message'=>'Balance Transfer to manager is successful!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }


    public function transectionSearch(Request $request){

        // echo $request->start.'00:00:00';die;
        $manager=User::find($request->manager_id);
        $start=$request->start;
        $end=$request->end;
        $transections=LabourTransection::where('given_by',$request->manager_id)->where('created_at','>=',$request->start.' 00:00:00')->where('created_at','<=',$request->end.' 00:00:00')->get(); 
        return view('admin.manager.transections',compact('transections','start','end','manager'));
    }
}
