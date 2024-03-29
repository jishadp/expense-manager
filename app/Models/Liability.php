<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liability extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function payments(){
        return $this->hasMany(Payment::class,'liability_id','id');
    }
    public function interests(){
        return $this->hasMany(Interest::class,'liability_id','id');
    }
    public function expenses(){
        return $this->hasMany(Expense::class,'liability_id','id');
    }
}
