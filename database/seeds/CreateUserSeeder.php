<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Super Admin',
            'email'=>'superadmin@blog.local',
            'password'=>Hash::make(123456),
        ]);
        User::create([
            'name'=>'Admin',
            'email'=>'admin@blog.local',
            'password'=>Hash::make(123456),
        ]);
    }
}
