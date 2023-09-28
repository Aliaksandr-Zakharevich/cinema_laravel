<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'duration' => $this->faker->numberBetween(90, 220),
            'age_limit' => $this->faker->numberBetween(0, 18),
            'release_year' => $this->faker->numberBetween(1950, 2023),
            'film_director' => $this->faker->lastName(),
            'poster' => 'https://source.unsplash.com/featured/640x480',
            'trailer' => 'src="https://www.youtube.com/embed/UiIRlg4Xr5w?si=9MjIaLkPQVM-dCjR"'
        ];
    }
}
