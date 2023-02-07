<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'user_id',

        'slug',

        'content',
        'excerpt',

    ];

    public function scopeFilter($query, array $filters)
    {


        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('content', 'like', '%' . $filters['search'] . '%');
        }

        if ($filters['categories'] ?? false) {
            $categories = explode(',', $filters['categories']);
            $query->whereHas('categories', function ($q) use ($categories) {
                $q->whereIn('category_id', $categories);
            });
        }
    }

    public function registerMediaConversions(Media $media = null): void
    {

        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->nonQueued();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship To Comments
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id')->whereNull('parent_id')->with(['user', 'replies'])->withTrashed();
    }
}