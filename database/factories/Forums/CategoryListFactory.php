<?php

namespace Database\Factories\Forums;

use App\Http\Controllers\Forums\CategoryList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Forums\CategoryList>
 */
class CategoryListFactory extends Factory
{

    protected $model = CategoryList::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
