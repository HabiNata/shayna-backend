<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name(),
            'slug'          => $this->faker->slug(),
            'description'   => $this->faker->sentence(),
            'type'          => $this->faker->fileExtension(),
            'quantity'      => rand(1, 100),
            'price'         => rand(15000, 100000),
        ];
    }
}
