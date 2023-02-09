<?php

namespace App\Models;

use App\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'short_description',
        'long_description',
        'regular_price',
        'selling_price',



    ];

    public function scopeFilter($query, array $filters)
    {


        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('short_description', 'like', '%' . $filters['search'] . '%')
                ->orWhere('long_description', 'like', '%' . $filters['search'] . '%');
        }

        if ($filters['categories'] ?? false) {

            $categories =  $filters['categories'];
            $query->whereHas('categories', function ($q) use ($categories) {
                $q->whereIn('category_id', $categories);
            });
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
