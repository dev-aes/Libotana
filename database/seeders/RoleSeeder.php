<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $roles = array(
           ['name' => 'admin', 'created_at' => now()],
           ['name' => 'user', 'created_at' => now()],
       );

       Role::insert($roles);
    }
}
