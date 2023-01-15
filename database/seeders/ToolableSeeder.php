<?php

namespace Database\Seeders;

use App\Models\Toolable;
use Illuminate\Database\Seeder;

class ToolableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Toolable::factory(10)->create();
    }
}
