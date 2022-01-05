<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get Categories Tree
     *
     * @param object $categories
     * @return mixed
     */
    public static function nestable(object $categories): mixed
    {
        foreach ($categories as $category) {
            if (!$category->children->isEmpty()) {
                $category->children = self::nestable($category->children);
            }
        }
        return $categories;
    }
}
