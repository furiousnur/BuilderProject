<?php

namespace App;

use App\Project;
use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    protected $guarded=[];

    public function project(){
    	return $this->belongsTo(Project::class);
    }

    public function attendences(){
    	return $this->hasMany(Attendence::class);
    }
}
