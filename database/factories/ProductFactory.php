<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countryIds = collect(Country::all()->modelKeys());

        return [
            'name'        => fake()->catchPhrase(),
            'description' => fake()->realText(),
            'country_id'  => $countryIds->random(),
            'price'       => fake()->numberBetween(10, 900) * 100,
        ];
    }

    public function configure(): self
    {
        $categories = collect(Category::where('is_active', true)->get()->modelKeys());

        return $this->afterCreating(function (Product $product) use ($categories) {
            $product->categories()->sync($categories->random(rand(1, 3)));
        });
    }
}
