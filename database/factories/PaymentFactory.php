<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['credit', 'debit']),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
