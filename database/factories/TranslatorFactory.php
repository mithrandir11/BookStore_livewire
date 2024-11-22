<?php

namespace Database\Factories;

use App\Models\Translator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translator>
 */
class TranslatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        return [
            'name' => $name,
            'slug' => Str::customSlug($name),
        ];
    }

//     function customSlug($name)
// {
//     $slug = Str::slug($name);
//     $originalSlug = $slug;
//     $counter = 1;

//     // بررسی اینکه آیا slug تکراری است یا خیر
//     while (Translator::where('slug', $slug)->exists()) {
//         // اگر تکراری بود، یک عدد به انتهای آن اضافه کن
//         $slug = $originalSlug . '-' . $counter;
//         $counter++;
//     }

//     return $slug;
// }
}
