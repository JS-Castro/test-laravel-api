<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $games = [
            'The Legend of Zelda: Breath of the Wild',
            'Red Dead Redemption 2',
            'God of War',
            'Cyberpunk 2077',
            'Super Mario Odyssey',
            'The Witcher 3: Wild Hunt',
        ];
        $platforms = ['PS5', 'PS4', 'PS3', 'Xbox Series X', 'Xbox One', 'Nintendo Switch', 'pc'];

        return [
            'name' => fake()->randomElement($games),
            'platform' => fake()->randomElement($platforms),
            'company' => fake()->company(),
        ];
    }
}
