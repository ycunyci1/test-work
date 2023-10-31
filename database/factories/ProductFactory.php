<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Tag;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            if (fake()->boolean) {
                $tags = Tag::query()->inRandomOrder()->limit(rand(1, 3))->get();
                $product->tags()->attach($tags);
            }
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(10),
            'price' => rand(1000, 10000),
            'created_at' => $this->randomDateThisYear(),
        ];
    }

    private function randomDateThisYear(): DateTime
    {
        $end = Carbon::now();
        $start = $end->clone()->startOfYear();
        $randomTimestamp = rand($start->timestamp, $end->timestamp);

        return Carbon::createFromTimestamp($randomTimestamp);
    }
}
