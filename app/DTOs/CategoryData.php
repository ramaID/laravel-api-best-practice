<?php

namespace App\DTOs;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

/** @typescript */
class CategoryData extends Data
{
    public function __construct(
        public ?string $ulid = null,
        public string $name,
        public ?string $slug = null,
        public ?string $description,
        public ?Carbon $created_at,
        public ?Carbon $updated_at,
    ) {
    }

    public static function authorize(): bool
    {
        return true;
    }

    public function storing(): self
    {
        $category = Category::query()->create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
        ]);

        return $this->from($category);
    }

    public function updating(Category $category): self
    {
        $category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
        ]);

        return $this->from($category->fresh());
    }
}
