<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'comment' => $this->faker->sentence(),
            'employee_id' => $this->faker->numberBetween(1, 3),
            'customer_id' => $this->faker->numberBetween(4, 5),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Declined']),
        ];
    }
}
