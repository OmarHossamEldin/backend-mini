<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Repositories\Admin\CategoryRepository;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Helpers\JsonResponse;
use Lang;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param CategoryRepository $categoryRepository
     * @return JsonResponse
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->list();

        return JsonResponse::response(data: ['categories' => $categories], statusCode: 200);
    }

    /**
     * store a newly created resource in storage
     *
     * @param StoreRequest $request
     * @param CategoryRepository $categoryRepository
     * @return JsonResponse
     */
    public function store(StoreRequest $request, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->create($request->validated());

        return JsonResponse::response(message: Lang::get('db.success'), data: ['category' => $category], statusCode: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return JsonResponse
     */
    public function show(Category $category)
    {
        return JsonResponse::response(data: ['category' => $category], statusCode: 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  Category  $category
     * @param CategoryRepository $categoryRepository
     * @return JsonResponse
     */
    public function update(UpdateRequest  $request, Category $category, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->update($request->validated(), $category);

        return JsonResponse::response(message: Lang::get('db.success'), data: ['category' => $category], statusCode: 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @param CategoryRepository $categoryRepository
     * @return JsonResponse
     */
    public function destroy(Category $category, CategoryRepository $categoryRepository)
    {
        $result = $categoryRepository->delete($category);
        return $result ? JsonResponse::response(message: Lang::get('db.success'), statusCode: 200) : 'error';
    }
}
