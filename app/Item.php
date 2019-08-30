<?php

namespace App;

use App\Vendor;
use App\ItemLog;
use App\Project;
use App\ItemName;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded=[];

    public function vendor(){
    	return $this->belongsTo(Vendor::class);
    }
    public function itemName(){
    	return $this->belongsTo(ItemName::class);
    }
    public function itemLog(){
    	return $this->hasOne(ItemLog::class);
    }
}
