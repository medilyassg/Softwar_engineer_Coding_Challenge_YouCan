<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'parent_category_id' => Category::inRandomOrder()->value('id')
        ];
    }
}
