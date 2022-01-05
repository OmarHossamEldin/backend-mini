<?php

namespace App\Repositories\Admin;

use App\Models\Category;

class CategoryRepository 
{
    
    /**
     * List resources in the database
     *
     * @return array
     */
    public function list(): array
    {
        $categories = Category::whereNull('parent_id')->get();
        $categories = Category::nestable($categories)->toArray();
        return $categories;
    }
    /**
     * Saves the resource in the database
     *
     * @param array $validatedData
     * @return object
     */
    public function create(array $validatedData): object
    {
        $category = Category::create($validatedData);
        return $category;
    }

    /**
     * Updates the resource in the database
     *
     * @param array $validatedData
     * @param object $category
     * @return object
     */
    public function update(array $validatedData, object $category): object
    {
        $category->update($validatedData);
        return $category;
    }

    /**
     * Deletes the resource in the database
     *
     * @param object $category
     * @return string
     */
    public function delete(object $category): int
    {
        $category->delete();
        return $category->id;
    }
}
