<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable=[
     "client_id",
     "user_id",
     "amount",
     "interest_rate",
     "start_date",
     "due_date",
     "status"
    ];

    //Relación cliente
    public function client(){
        return $this->belongsTo(Client::class);
    }

    //Realción user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion payments
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
