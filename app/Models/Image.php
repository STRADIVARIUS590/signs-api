<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path'];
    use HasFactory;

    public function datas(){
        return $this->morphedByMany(Data::class, 'imageable');
    }
}
