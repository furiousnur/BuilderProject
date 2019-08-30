<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

class ItemLog extends Model
{
    protected $guarded=[];

    public function item(){
    	return $this->belongsTo(Item::class);
    }

    public function project(){
    	return $this->belongsTo(Project::class);
    }

    public function transferFrom(){
    	return $this->belongsTo(Project::class,'transfer_from');
    }

}
