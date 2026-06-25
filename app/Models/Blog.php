<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'content',
        'image',
        'status',
        'title',
        'description',
        'keywords',
        'slug',
        'lang'
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
