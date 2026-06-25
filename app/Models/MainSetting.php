<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainSetting extends Model
{
    protected $fillable = ['key', 'value', 'type'];
}
