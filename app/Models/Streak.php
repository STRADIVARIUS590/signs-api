<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Streak extends Model
{
    use HasFactory;

    protected $fillable = [
        'token'
    ];

    public function questions(){
        return $this->belongsToMany(Question::class)->withPivot('status');
    }
}
