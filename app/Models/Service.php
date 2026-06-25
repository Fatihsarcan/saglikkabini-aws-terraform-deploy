<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Service extends Model
{
    use Sluggable;

    protected $fillable = ['category_id', 'name', 'slug', 'content', 'price', 'image', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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
