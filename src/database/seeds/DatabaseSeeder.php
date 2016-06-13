<?php

namespace Nhiepphong\Backend\Seeder;

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
        $this->call(\Nhiepphong\Backend\Seeder\AdminTableSeeder::class);
        $this->call(\Nhiepphong\Backend\Seeder\MenuTableSeeder::class);
    }
}
