<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Team extends Model
{
    use Sluggable;
    protected $fillable = [
       
        'name',
        'slug',
        'image',
        'content',
        'short_content',
        'facebook',
        'twitter',
        'instagram',
        'linkedin'
    ];

    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        return asset($this->image);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
