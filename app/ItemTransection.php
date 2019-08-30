<?php

namespace App;

use App\Bank;
use App\Item;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ItemTransection extends Model
{
    protected $guarded=[];

    public function bank(){
    	return $this->belongsTo(Bank::class);
    }
    public function item(){
    	return $this->belongsTo(Item::class);
    }
    public function user(){
    	return $this->belongsTo(User::class,'given_by');
    }
}
