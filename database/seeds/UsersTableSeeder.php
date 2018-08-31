<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\RolUser;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'     => 'Admin',
            'slug'     => 'admin',
            'special'  => 'all-access',
        ]);

        RolUser::create([
            'role_id'   =>  '1',
            'user_id'   =>  '1300019'
        ]);
    }
}
