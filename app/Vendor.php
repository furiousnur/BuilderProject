<?php

namespace App;

use App\Item;
use App\BankRecharge;
use App\ItemTransection;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded = [];

    public function items(){
    	return $this->hasMany(Item::class);
    }
    public function itemTransections(){
    	return $this->hasMany(ItemTransection::class);
    }
}
