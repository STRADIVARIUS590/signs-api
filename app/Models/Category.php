<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function data(){
        return $this->belongsToMany(Data::class);
    }

    public function user(){
        return $this->belongsToMany(User::class)->withPivot('score');
    }
}