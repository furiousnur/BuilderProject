<?php

namespace App;

use App\Labour;
use App\ItemLog;
use App\Attendence;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded=[];

    public function labours(){
    	return $this->hasMany(Labour::class);
    }

    public function attendences(){
    	return $this->hasMany(Attendence::class);
    }

    public function items(){
    	return $this->hasMany(ItemLog::class);
    }

    public function coustomers(){
    	return $this->hasMany(Coustomer::class);
    }

    public function manager ()
    {
        return $this->belongsTo(Manager::class);
    }
}
