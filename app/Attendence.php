<?php

namespace App;

use App\Labour;
use App\Project;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $guarded=[];

    public function labour(){
    	return $this->belongsTo(Labour::class);
    }

    public function project(){
    	return $this->belongsTo(Project::class);
    }
}
