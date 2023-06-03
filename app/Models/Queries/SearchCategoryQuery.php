<?php

namespace App\Models\Queries;

use App\Models\Category;
use App\Support\Filters\FuzzyFilter;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class SearchCategoryQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        parent::__construct(Category::query(), $request);

        $this->allowedSorts([AllowedSort::field('name'), AllowedSort::field('description')]);
        $this->allowedFilters(['name', 'slug', 'description', $this->searching()]);
    }

    private function searching(): AllowedFilter
    {
        return AllowedFilter::custom('search', new FuzzyFilter('name', 'slug', 'description'));
    }
}
