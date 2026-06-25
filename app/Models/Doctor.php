<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Doctor extends Model
{
    protected $fillable = ['name', 'specialty', 'photo', 'bio', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function timeSlots(): HasMany
    {
        return $this->hasMany(TimeSlot::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return Storage::url($this->photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&size=200&background=0D8ABC&color=fff';
    }
}
