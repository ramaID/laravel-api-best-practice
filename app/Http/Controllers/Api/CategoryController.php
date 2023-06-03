<?php

namespace App\Http\Controllers\Api;

use App\DTOs\CategoryData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Queries\SearchCategoryQuery;
use App\Resources\CategoryResource;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\Subgroup;

/**
 * @group V1
 * First version of the API
 */
#[Subgroup('Category', 'APIs for managing categories. List columns by which you can sort and filter: name, slug, description')]
class CategoryController extends Controller
{
    /**
     * Listing
     */
    #[QueryParam('filter[search]', 'string', 'Searching all column (fuzzy search / <strong>LIKE %query%</strong>)', required: false)]
    #[QueryParam('filter[name]', 'string', required: false)]
    #[QueryParam('filter[slug]', 'string', required: false)]
    #[QueryParam('filter[description]', 'string', required: false)]
    #[QueryParam('sort', 'string', 'sorting by column, add - in front for descending', false, '-name')]
    public function index(SearchCategoryQuery $query)
    {
        return CategoryResource::collection($query->jsonPaginate());
    }

    /**
     * Storing
     */
    #[BodyParam('name')]
    #[BodyParam('description', required: false)]
    public function store(CategoryData $category)
    {
        $category->storing();
        return CategoryResource::make($category);
    }

    /**
     * Showing
     */
    public function show(Category $category)
    {
        return CategoryResource::make($category);
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
