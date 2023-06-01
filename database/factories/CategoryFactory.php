<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words($this->faker->numberBetween(2, 5), true);

        return [
            'ulid' => Str::ulid(),
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }

    /**
     * Indicate that the model's description should be filled with faker description.
     */
    public function description(): static
    {
        return $this->state(fn () => ['description' => $this->faker->realText(120)]);
    }
}
