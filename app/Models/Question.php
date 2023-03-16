<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    public function answers(){
        return $this->hasOne(Answer::class);
    }

    public static function random($amount = 1, $column = 'id'){
        $col = static::select($column)->inRandomOrder()->limit($amount)->get()->pluck($column);
        return  $amount==1? $col[0] : $col;
    }
}
