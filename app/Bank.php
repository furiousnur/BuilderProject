<?php

namespace App;

use App\BankRecharge;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
	protected $guarded=[];

    public function recharges(){
    	return $this->hasMany(BankRecharge::class);
    }
}
