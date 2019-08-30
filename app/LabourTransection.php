<?php

namespace App;

use App\Labour;
use Illuminate\Database\Eloquent\Model;

class LabourTransection extends Model
{
    protected $guarded=[];

    public function labour(){
    	return $this->belongsTo(Labour::class);
    }
}
