<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}