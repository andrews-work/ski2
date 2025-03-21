<?php

namespace Database\Factories\Forums;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryListFactory extends Factory
{
    protected $model = CategoryListModel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
