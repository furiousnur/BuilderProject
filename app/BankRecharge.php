<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankRecharge extends Model
{
    protected $guarded=[];

    public function bank(){
    	return $this->belongsTo(Bank::class);
    }
}
