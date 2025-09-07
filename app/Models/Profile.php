<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'email',
        'phone',
        'address',
        'image',
    ];

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('uploads/' . $this->logo);
        }
        return null;
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('uploads/' . $this->image);
        }
        return null;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
