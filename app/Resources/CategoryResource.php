<?php

namespace App\Resources;

use TiMacDonald\JsonApi\JsonApiResource;
use TiMacDonald\JsonApi\Link;

class CategoryResource extends JsonApiResource
{
    /**
     * @var string[]
     */
    public $attributes = [
        'name',
        'slug',
        'description',
        'created_at',
        'updated_at',
    ];

    public function toLinks($request): array
    {
        return [
            Link::self(route('categories.show', $this->resource)),
        ];
    }
}
