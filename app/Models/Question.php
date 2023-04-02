<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function answers(){
        return $this->belongsToMany(Data::class);
    }

    public static function random($amount = 1, $column = 'id'){
        $col = static::select($column)->inRandomOrder()->limit($amount)->get()->pluck($column);
        return  $amount==1? $col[0] : $col;
    }

/*     public function answerType() : Attribute{
        return 
    } */
}
