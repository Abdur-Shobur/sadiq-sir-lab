<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_category_id',
        'title',
        'subtitle',
        'image',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Get the blog category that owns the blog.
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    /**
     * Scope a query to only include active blogs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to order blogs by latest first.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get the blog's image URL.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('uploads/' . $this->image);
        }
        return asset('assets/img/default-blog.jpg');
    }
}
