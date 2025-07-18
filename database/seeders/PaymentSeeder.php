<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); 

        if ($user) {
            Payment::create([
                'user_id' => $user->id,
                'amount' => 150.75,
                'description' => 'دفعة أولى'
            ]);

            Payment::create([
                'user_id' => $user->id,
                'amount' => 299.99,
                'description' => 'دفعة نهائية'
            ]);
        }
    }
}
