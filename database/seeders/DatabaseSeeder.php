<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PaymentTypeSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            ToolSeeder::class,
            ArtistSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,

            RequestSeeder::class,
            ContactSeeder::class,
            HelpSeeder::class,
            ToolableSeeder::class,
            CurrencySeeder::class,
            NewsCategorySeeder::class,
        ]);
    }
}
