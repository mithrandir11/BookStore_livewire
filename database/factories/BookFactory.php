<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Translator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageNames = [
            'cover1.jpg', 'cover2.jpg', 'cover3.jpg', 'cover4.jpg',
            'cover5.jpg', 'cover6.jpg', 'cover7.jpg', 'cover8.jpg',
            'cover9.jpg', 'cover10.jpg', 'cover11.jpg', 'cover12.jpg',
        ];
        $title = fake()->sentence(3);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'price' => $this->generatePrice(),
            'quantity' => fake()->numberBetween(1, 10),
            'image' => url(env('APP_URL').'images/covers/' . Arr::random($imageNames)),
            'description' => fake()->sentence(100),
            'author_id' => Author::inRandomOrder()->first()->id,
            'publisher_id' => Publisher::inRandomOrder()->first()->id,
            'translator_id' => Translator::factory(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'pages' => fake()->numberBetween(100, 1000),
            'published_year' => fake()->year(),
            'isbn' => fake()->isbn13(),
        ];
    }

    private function generatePrice()
    {
        $minPrice = 45000;
        $maxPrice = 150000;
        $price = fake()->numberBetween($minPrice, $maxPrice);
        return round($price / 500) * 500;
    }
}
