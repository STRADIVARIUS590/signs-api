<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];
    public function questions(){
        return $this->belongsToMany(Question::class);
    }
}
