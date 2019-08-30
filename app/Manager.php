<?php

namespace App;

use App\User;
use App\Project;
use App\ManagerTransection;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $guarded=[];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function project(){
    	return $this->belongsTo(Project::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function managerTransection ()
    {
        return $this->hasMany(ManagerTransection::class,'manager_id');
    }
}
