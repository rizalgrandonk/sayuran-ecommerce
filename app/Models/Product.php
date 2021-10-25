<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
        'detail',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'orders', 'product_id', 'transaction_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters["category"] ?? false, function ($query, $category) {
            return $query->whereHas("category", function ($query) use ($category) {
                $query->where("slug", $category);
            });
        });
    }
}
