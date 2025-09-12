<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table = 'researches';

    protected $fillable = [
        'title',
        'description',
        'long_description',
        'image',
        'link',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('uploads/' . $this->image);
        }
        return null;
    }
}
