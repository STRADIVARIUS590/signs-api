<?php

namespace App\Models;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use PharIo\Manifest\Url as ManifestUrl;

class Category extends Model
{
    use HasFactory;

    protected $appends = [
        'image_path'
    ];

    public function data(){
        return $this->belongsToMany(Data::class);
    }

    public function user(){
        return $this->belongsToMany(User::class)->withPivot('score');
    }
    public function images(){
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function getImagePathAttribute(){
        
        return $this->images->isEmpty() ? null : $this->images->first()->path;
        // return $this->images->first()->path ? : null;
    }


}
