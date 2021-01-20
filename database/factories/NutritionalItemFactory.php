<?php

namespace Database\Factories;

use App\Models\NutritionalItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutritionalItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NutritionalItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->word
        ];
    }
}
