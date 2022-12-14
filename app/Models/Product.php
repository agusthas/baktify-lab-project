<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function cartDetails(): HasMany
    {
        return $this->hasMany(CartDetail::class, 'product_id');
    }

    /**
     * @comment Scope a query to only include products when search match either in name or description
     */
    public function scopeSearch(Builder $query, $search): Builder
    {
        if (!is_null($search)) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }
        return $query;
    }
}
