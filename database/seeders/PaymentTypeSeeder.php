<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create([
            'name' => 'Click',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        PaymentType::create([
            'name' => 'Payme',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        PaymentType::create([
            'name' => 'PayPal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        PaymentType::create([
            'name' => 'Visa Card',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        PaymentType::create([
            'name' => 'UzCard',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        PaymentType::create([
            'name' => 'Anor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
