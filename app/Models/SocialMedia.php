<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Get active social media links ordered by created_at
     */
    public static function getActive()
    {
        return static::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get icon class for the platform
     */
    public function getIconClass()
    {

        $iconMap = [
            'facebook'      => 'facebook.png',
            'twitter'       => 'twitter.png',
            'instagram'     => 'instagram.png',
            'linkedin'      => 'linkedin.png',
            'youtube'       => 'youtube.png',
            'github'        => 'github.png',
            'pinterest'     => 'pinterest.png',
            'discord'       => 'discord.png',
            'ResearchGate'  => 'researchgate.jpg',
            'GoogleScholar' => 'google-scholar.png',
        ];

        return $iconMap[$this->platform] ?? 'link.png';
    }
}
