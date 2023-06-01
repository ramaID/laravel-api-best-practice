<?php

namespace App\Http\Controllers\Api;

use App\DTOs\CategoryData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * @group V1
 * First version of the API
 * @subgroup Category
 * @subgroupDescription APIs for managing categories
 */
class CategoryController extends Controller
{
    /**
     * Listing
     */
    public function index()
    {
        return CategoryData::collection(Category::query()->paginate(15));
    }

    /**
     * Storing
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Showing
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Updating
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Deleting
     */
    public function destroy(string $id)
    {
        //
    }
}
