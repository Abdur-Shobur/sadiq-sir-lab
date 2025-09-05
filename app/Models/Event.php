<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'event_date',
        'event_time',
        'time',
        'location',
        'is_active',
        'order',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime',
        'is_active'  => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    public function scopePast($query)
    {
        return $query->where('status', 'past');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    public function getFormattedEventDateAttribute()
    {
        return $this->event_date ? $this->event_date->format('M d, Y') : null;
    }

    public function getFormattedEventTimeAttribute()
    {
        return $this->event_time ? $this->event_time->format('h:i A') : null;
    }
}
