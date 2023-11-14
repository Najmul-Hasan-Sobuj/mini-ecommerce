<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words(3, true) . $this->faker->randomNumber();

        // Expanded size options
        $sizeOptions = ['s', 'm', 'l', 'xl', 'xxl', '64gb', '128gb', '512gb', '1tb'];

        // Expanded color options
        $colorOptions = ['white', 'yellow', 'blue', 'red', 'green', 'black', 'brown', 'azure', 'ivory', 'teal', 'silver', 'purple', 'navy_blue', 'pea_green', 'gray', 'orange', 'maroon', 'charcoal', 'aquamarine', 'coral', 'fuchsia', 'wheat', 'lime', 'crimson', 'khaki', 'hot_pink', 'magenta', 'olden', 'plum', 'olive', 'cyan'];

        return [
            'category_id' => Category::query()->inRandomOrder()->first()->id ?? Category::factory()->create()->id,
            'brand_id'    => Brand::query()->inRandomOrder()->first()->id ?? Brand::factory()->create()->id,
            'name'        => $name,
            'slug'        => Str::slug($name),
            'image'       => $this->faker->imageUrl(),
            'sku'         => 'SKU' . $this->faker->unique()->randomNumber(8) . '_' . time(),
            'description' => $this->faker->paragraph,
            'price'       => $this->faker->randomFloat(2, 10, 1000),
            'quantity'    => $this->faker->numberBetween(0, 100),
            'status'      => $this->faker->randomElement(['active', 'inactive']),
            'sizes'       => json_encode($this->faker->randomElements($sizeOptions, $this->faker->numberBetween(1, count($sizeOptions)))),  // Convert array to JSON
            'colors'      => json_encode($this->faker->randomElements($colorOptions, $this->faker->numberBetween(1, count($colorOptions)))),  // Convert array to JSON
            'tags'        => json_encode($this->faker->words($this->faker->numberBetween(1, 5))),  // Convert array to JSON
            'created_by'  => User::query()->inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'updated_by'  => User::query()->inRandomOrder()->first()->id ?? User::factory()->create()->id,
        ];
    }
}
