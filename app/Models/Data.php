<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    protected $appends = [
        'image_path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];
    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function images(){
        return $this->morphToMany(Image::class, 'imageable');
    }

     public function getImagePathAttribute(){
        return $this->images->isEmpty() ? null : $this->images->first()->path;
        //  return 'werw';
    }



}
