<?php

namespace Database\Factories\Forums;

use App\Http\Controllers\Forums\CategoryListController;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryListFactory extends Factory
{
    protected $model = CategoryListController::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
