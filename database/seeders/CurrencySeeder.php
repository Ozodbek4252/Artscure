<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'UZS',
            'value' => 1,
        ]);

        Currency::create([
            'name' => 'USD',
            'value' => 1,
        ]);

        Currency::create([
            'name' => 'EUR',
            'value' => 1,
        ]);
    }
}
