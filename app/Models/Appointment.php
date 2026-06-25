<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['name', 'phone', 'date', 'time', 'team_id', 'service_id', 'status'];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
