<?php

namespace App;

use App\Manager;
use Illuminate\Database\Eloquent\Model;

class ManagerTransection extends Model
{
	protected $guarded=[];

    public function manager(){
    	return $this->belongsTo(Manager::class);
    }
    public function bank(){
    	return $this->belongsTo(Bank::class);
    }
}
