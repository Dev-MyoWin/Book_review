<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()

    {
        return [
            'user_id'=> $this->faker->unique(true)->numberBetween(1,5),
            'book_id'=> $this->faker->unique(true)->numberBetween(1,5),
            'description'=> $this->faker->sentence,
            'rating'=> $this->faker->unique(true)->numberBetween(1,5),
            'status' => $this->faker->boolean,
        ];
    }
}
