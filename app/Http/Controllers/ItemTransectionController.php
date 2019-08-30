<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Item;
use App\Vendor;
use App\ItemLog;
use App\Manager;
use App\Project;
use App\BankRecharge;
use App\ItemTransection;
use App\ManagerTransection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemTransectionController extends Controller
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
        if (Auth::user()->role==1) {
            $validate = validator()->make($request->all(),[
                'date'=> 'required',
                'bank_id'=> 'required',
                'paid'=> 'required',
            ]);

            if ($validate->fails()) {
                $notification=array(
                    'message' => 'Oops! Please fill all field required field!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

            $balance=Bank::find($request->bank_id)->recharges()->where('type','CREDIT')->sum('amount');

            if ($balance < $request->paid) {
                $notification=array(
                    'message' => 'Oops! Insufficient balance in this account!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
            $data=$request->all();
            $data['given_by']=Auth::user()->id;

            $store=ItemTransection::create($data);

            $lastBalance=BankRecharge::where('bank_id',$request->bank_id)->orderBy('created_at','DESC')->first();
            $debitableBalance=$lastBalance->balance-$request->paid;

            $bankDebit=BankRecharge::create([
                'bank_id' =>$request->bank_id,
                'vendor_id' =>$request->vendor_id,
                'amount' =>$request->paid,
                'date' =>$request->date,
                'type' => 'DEBIT',
                'balance'=> $debitableBalance,
            ]);
            $notification=array(
                    'message' => 'Transection Successful',
                    'alert-type' => 'success'
                );
            return redirect()->back()->with($notification);
        }



        else{
            $validate = validator()->make($request->all(),[
                'date'=> 'required',
                'paid'=> 'required',
            ]);

            if ($validate->fails()) {
                $notification=array(
                    'message' => 'Oops! Please fill all field required field!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

            $vendor=Vendor::find($request->vendor_id)->toArray();

            $manager=Manager::where('user_id',Auth::user()->id)->first();
            $project=Project::where('id',$manager->project_id)->pluck('id')->toArray();

            if (array_search($vendor['id'], $project) !== FALSE) {
                $data=$request->all();
                $data['given_by']=Auth::user()->id;
                $data['bank_id']=0;
                $store=ItemTransection::create($data);


                $managerTransection= ManagerTransection::create([
                    'manager_id'=>Auth::user()->id,
                    'vendor_id'=>$request->vendor_id,
                    'amount'=>$request->paid,
                    'type'=>'DEBIT',
                ]);

                $notification=array(
                        'message' => 'Transection Successful',
                        'alert-type' => 'success'
                    );
                return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'message' => 'Oops! You are UnAuthorize!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemTransection  $itemTransection
     * @return \Illuminate\Http\Response
     */
    public function show(ItemTransection $itemTransection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemTransection  $itemTransection
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemTransection $itemTransection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemTransection  $itemTransection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemTransection $itemTransection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemTransection  $itemTransection
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemTransection $itemTransection)
    {
        //
    }
}
