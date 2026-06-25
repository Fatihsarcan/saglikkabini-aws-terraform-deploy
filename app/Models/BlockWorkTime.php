<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockWorkTime extends Model
{
    protected $fillable = ['team_id', 'start_time', 'end_time', 'status'];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
