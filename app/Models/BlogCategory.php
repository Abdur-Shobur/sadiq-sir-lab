<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Scope a query to only include active blog categories.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get the blogs for the category.
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id');
    }
}
