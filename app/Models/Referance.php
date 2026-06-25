<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referance extends Model
{
    protected $fillable = ['name', 'content', 'image', 'status'];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        return asset($this->image);
    }
}
