<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model {
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
    public function getRouteKeyName() {
        return 'id';
    }

    /**
     * Get active social media links ordered by created_at
     */
    public static function getActive() {
        return static::where( 'is_active', true )
            ->orderBy( 'created_at', 'desc' )
            ->get();
    }

    /**
     * Get icon class for the platform
     */
    public function getIconClass() {
        $iconMap = [
            'facebook'      => 'fab fa-facebook-f',
            'twitter'       => 'fab fa-twitter',
            'instagram'     => 'fab fa-instagram',
            'linkedin'      => 'fab fa-linkedin-in',
            'youtube'       => 'fab fa-youtube',
            'github'        => 'fab fa-github',
            'tiktok'        => 'fab fa-tiktok',
            'pinterest'     => 'fab fa-pinterest-p',
            'reddit'        => 'fab fa-reddit-alien',
            'discord'       => 'fab fa-discord',
            'ResearchGate'  => 'fab fa-researchgate',
            'GoogleScholar' => 'fab fa-google-scholar',
        ];

        return $iconMap[$this->platform] ?? 'fas fa-link';
    }
}
