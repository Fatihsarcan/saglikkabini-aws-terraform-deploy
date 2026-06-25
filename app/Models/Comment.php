<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'content', 'star', 'service_id', 'status'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
