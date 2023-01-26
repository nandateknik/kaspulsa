<?php

use App\Models\Role;
namespace Database\Seeders;

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
        //
        Role::create(
            ['role' => 'SUPERADMIN']
        );

    }
}
