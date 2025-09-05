<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'date' => $this->faker->dateTimeBetween('+1 day', '+1 month'),
        ];
    }
}
