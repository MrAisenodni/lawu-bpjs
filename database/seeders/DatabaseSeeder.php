<?php

namespace Database\Seeders;

use Database\Seeders\Settings\ProviderSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProviderSeeder::class,
        ]);
    }
}
