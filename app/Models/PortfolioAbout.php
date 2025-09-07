<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioAbout extends Model
{
    use HasFactory;

    protected $table = 'portfolio_abouts';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image1',
        'image2',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor for image1 URL
    public function getImage1UrlAttribute()
    {
        if ($this->image1) {
            return asset('uploads/' . $this->image1);
        }
        return null;
    }

    // Accessor for image2 URL
    public function getImage2UrlAttribute()
    {
        if ($this->image2) {
            return asset('uploads/' . $this->image2);
        }
        return null;
    }
}
