<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $guarded = [];
    protected static $slider;
    public static $image;
    protected static $imageName;
    protected static $imageDirectory;
    protected static $imageUrl;

    protected static function storeSlider($request)
    {
       return self::create([
            'big_title' => $request['big_title'],
            'small_title' => $request['small_title'],
            'image' => self::$image
        ]);
    }
}
