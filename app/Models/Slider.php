<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['lang', 'name', 'content', 'button_text', 'button_link', 'image', 'status'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset($this->image);
    }
}
