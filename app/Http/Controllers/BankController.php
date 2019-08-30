<?php

namespace App\Http\Controllers;

use App\Bank;
use App\User;
use App\Manager;
use App\Coustomer;
use App\BankRecharge;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks=Bank::all();
        $managers=User::where('role',3)->get();
        $coustomers=Coustomer::all();
        return view('admin.accounting.banks.index',compact('banks','managers','coustomers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        ]);

        if ($validate->fails()) {
            $notification=array(
                'message' => 'Please Input field properly!',
                'alert-type' =>'error'
            );

            return redirect()->back()->with($notification);
        }

        $store=Bank::create($request->all());

        if ($store) {
            $notification=array(
                'message' => 'Bank added properly!',
                'alert-type' =>'success'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function rechageStore(Request $request)
    {
        $validate= validator()->make($request->all(),[
            'bank_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);

        if ($validate->fails()) {
            $notification=array(
                'message' => 'Please Input field properly!',
                'alert-type' =>'error'
            );

            return redirect()->back()->with($notification);
        }

        $lastBalance=BankRecharge::where('bank_id',$request->bank_id)->orderBy('created_at','DESC')->first();
        if (!isset($lastBalance)) {
           $creaditableBalance=0+$request->amount;
        }else{
            $creaditableBalance=$lastBalance->balance+$request->amount;
        }

        

        $store=BankRecharge::create([
            'bank_id' => $request->bank_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'type' =>$request->type,
            'balance' =>$creaditableBalance,
        ]);

        if ($store) {
            $notification=array(
                'message' => 'Bank added properly!',
                'alert-type' =>'success'
            );

            return redirect()->back()->with($notification);
        }
    }





public function rechageCoustomer(Request $request)
    {
        $validate= validator()->make($request->all(),[
            'coustomer_id' => 'required',
            'bank_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);

        if ($validate->fails()) {
            $notification=array(
                'message' => 'Please Input field properly!',
                'alert-type' =>'error'
            );

            return redirect()->back()->with($notification);
        }

        $lastBalance=BankRecharge::where('bank_id',$request->bank_id)->orderBy('created_at','DESC')->first();
        if (!isset($lastBalance)) {
           $creaditableBalance=0+$request->amount;
        }else{
            $creaditableBalance=$lastBalance->balance+$request->amount;
        }

        

        $store=BankRecharge::create([

            'bank_id' => $request->bank_id,
            'coustomer_id' => $request->coustomer_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'type' =>'CREDIT',
            'balance' =>$creaditableBalance,
        ]);

        if ($store) {
            $notification=array(
                'message' => 'Income Added!',
                'alert-type' =>'success'
            );

            return redirect()->back()->with($notification);
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank=Bank::find($id);

        return view('admin.accounting.banks.show',compact('bank'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        //
    }

    public function income(){
        $transections=BankRecharge::where('type','CREDIT')->get();
        return view('admin.accounting.income',compact('transections'));
    }

    public function expence(){
        $transections=BankRecharge::where('type','DEBIT')->get();
        return view('admin.accounting.expence',compact('transections'));
    }
}
