<?php

namespace App\Models\Queries;

use App\Models\Category;
use App\Support\Filters\FuzzyFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SearchCategoryQuery extends QueryBuilder
{
    public Model $model;

    public function __construct(Request $request)
    {
        $this->model = new Category();
        parent::__construct($this->model->query(), $request);
        $columns = $this->getColumns();
        $this
            ->defaultSort('-ulid')
            ->allowedSorts($columns)
            ->allowedFilters($columns + [$this->searching()]);
    }

    private function searching(): AllowedFilter
    {
        return AllowedFilter::custom('search', new FuzzyFilter('name', 'slug', 'description'));
    }

    private function getColumns(): array
    {
        return Cache::remember('columns_' . $this->model->getTable(), 60 * 60 * 24, function () {
            $columns = Schema::getColumnListing($this->model->getTable());
            return collect($columns)
                ->filter(fn ($column) => !in_array($column, ['id', 'ulid', 'created_at', 'updated_at']))
                ->toArray();
        });
    }
}
