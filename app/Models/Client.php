<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable=[
     "name",
     "lastName",
     "dni",
     "phone",
     "address"
    ];

    public function loans(){
 return $this->hasMany(Loan::class);
    }
}
