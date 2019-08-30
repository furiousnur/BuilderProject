<?php
// violate Repository sytem!
namespace App\Http\Controllers;

use App\Item;
use App\Vendor;
use App\ItemLog;
use App\Manager;
use App\Project;
use App\ItemName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ItemRepositoryInterface;
use App\Repositories\VendorRepositoryInterface;
use App\Repositories\ProjectRepositoryInterface;

class ItemController extends Controller
{
    protected $item;
    protected $vendor;
    protected $project;

    public function __construct(ItemRepositoryInterface $item, VendorRepositoryInterface $vendor, ProjectRepositoryInterface $project){
        $this->item = $item;
        $this->vendor = $vendor;
        $this->project = $project;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role==1) {
            $projects=$this->project->index();
            $items=$this->item->index();
            $itemNames=ItemName::all();
            return view('admin.inventory.lists', compact('projects','items','itemNames'));
        }else{
            $manager=Manager::where('user_id',Auth::user()->id)->first();
            $projects=Project::where('id',$manager->project_id)->get();
            $items=$this->item->index();
            $itemNames=ItemName::all();
            return view('admin.inventory.lists', compact('projects','items','itemNames'));
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
            $itemNames=ItemName::all();
            $projects=$this->project->index();
            $vendors=$this->vendor->index();
            return view('admin.inventory.add-item',compact('vendors','projects','itemNames'));
        }else{
            $itemNames=ItemName::all();
            $manager=Manager::where('user_id',Auth::user()->id)->first();
            $projects=Project::where('id',$manager->project_id)->get();
            $projectID=Project::where('id',$manager->project_id)->pluck('id');
            $vendors=Vendor::whereIn('project_id',$projectID)->get();
            return view('admin.inventory.add-item',compact('vendors','projects','itemNames'));
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
        $validate= validator()->make($request->all(),[
            'item_name_id' => 'required',
            'unit' => 'required',
            'quentity' =>'required',
            'cost'=>'required',
            'reusable' => 'required',
            'vendor_id' =>'required',
            'project' =>'required',
        ]);

        if ($validate->fails()) {
            $notification=array(
                'message' => 'Please Input field properly!',
                'alert-type' =>'error'
            );

            return redirect()->back()->withInput()->withErrors($validate)->with($notification);
        }

        $data=$request->except(['project']);
        $item=$this->item->store($data);

        $logData=array(
            'item_id' => $item->id,
            'project_id' => $request->project,
            'quentity' => $request->quentity,
            'active' => 1,
            'damaged' => 0
        );
        $itemLog=$this->item->log_store($logData);




        if ($item && $itemLog) {
            $notification = array(
                'message' => 'Item Added successful!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Opps. Item not added!',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id,$itemLogId)
    {
        $projects=$this->project->index();
        $item=$this->item->show($id);
        $log=ItemLog::find($itemLogId);
        return view('admin.inventory.item-details',compact('projects','item','log'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function ajaxLists(Request $request){
            $project=$this->project->show($request->pid);
            $items=$project->items;
            return view('admin.inventory.ajax-lists',compact('items','project'));
    }

    public function transfer(Request $request){
        $validate=validator()->make($request->all(),[
            'quentity' => 'required',
            'project_id' => 'required',
        ]);

        if ($validate->fails()) {
            $notification=array(
                'message' => 'Please Input all feild properly!',
                'alert-type' =>'error',
            );

            return redirect()->back()->withInput()->with($notification);
        }

        if ($request->quentity > $request->avilable_quentity) {
            $notification=array(
                'message' => 'Given quentity not available!!',
                'alert-type' =>'error'
            );

            return redirect()->back()->withInput()->with($notification);
        }

        if ($request->old_project_id == $request->project_id) {
            $notification=array(
                'message' => 'You can not transfer item in same project!!',
                'alert-type' =>'error'
            );

            return redirect()->back()->withInput()->with($notification);
        }

        $logMinus=ItemLog::where('item_id',$request->item_id)->where('project_id',$request->old_project_id)->orderBy('updated_at','DESC')->first();

        $logMinus->update([
            'quentity' =>$logMinus->quentity-$request->quentity,
        ]);

        $log=ItemLog::create([
            'item_id' => $request->item_id,
            'project_id' =>$request->project_id,
            'quentity' => $request->quentity,
            'transfer_from'=>$request->old_project_id,
            'active' => 1,
            'damaged' =>0,
        ]);

        if ($log) {
            $notification=array(
                'message' => 'Transfered!',
                'alert-type' =>'success'
            );

            return redirect()->back()->with($notification);
        }
        
    }
}
