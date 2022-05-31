<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image'          => 'product-images/AVoCRki30GQvH6xngYtElXg1xAldCKrjNcbYX0A5.jpg',
            'name'           => $this->faker->name(),
            'slug'           => $this->faker->slug(),
            'category_id'    => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'weight'         => $this->faker->numberBetween(50, 250),
            'stock'          => $this->faker->numberBetween(10, 80),
            'status'         => '0',
            'purchase_price' => 65000,
            'selling_price'  => 125000,
            'description'    => $this->faker->paragraph()
        ];
    }
}
