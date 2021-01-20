<?php

namespace Database\Factories;

use App\Models\AddableItem;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddableItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddableItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word,
            'price'=>$this->faker->numberBetween(10,150),
        ];
    }
}
