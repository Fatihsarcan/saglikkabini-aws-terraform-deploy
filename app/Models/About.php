<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['lang', 'name', 'content', 'vision', 'mission', 'image'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset( $this->image);
    }
}
