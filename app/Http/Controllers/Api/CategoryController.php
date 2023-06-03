<?php

namespace App\Http\Controllers\Api;

use App\DTOs\CategoryData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Queries\SearchCategoryQuery;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Subgroup;

/**
 * @group V1
 * First version of the API
 */
#[Subgroup('Category', 'APIs for managing categories')]
class CategoryController extends Controller
{
    /**
     * Listing
     */
    public function index(SearchCategoryQuery $query)
    {
        return CategoryData::collection($query->jsonPaginate());
    }

    /**
     * Storing
     */
    #[BodyParam('name')]
    #[BodyParam('description', required: false)]
    public function store(CategoryData $category)
    {
        return $category->storing();
    }

    /**
     * Showing
     */
    public function show(Category $category)
    {
        return CategoryData::from($category);
    }

    /**
     * Updating
     */
    #[BodyParam('name')]
    #[BodyParam('description', required: false)]
    public function update(CategoryData $categoryData, Category $category)
    {
        return $categoryData->updating($category);
    }

    /**
     * Deleting
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
