<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coustomer extends Model
{
    protected $guarded=[];

    public function deposits ()
    {
        return $this->hasMany(BankRecharge::class,'coustomer_id');
    }
}
