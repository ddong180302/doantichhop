<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        Roles::truncate();

        Roles::create(['name' => 'admin']);
        Roles::create(['name' => 'user']);
        Roles::create(['name' => 'employee']);
    }
}
