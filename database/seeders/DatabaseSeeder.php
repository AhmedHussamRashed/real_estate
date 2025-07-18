<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            Payment::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
