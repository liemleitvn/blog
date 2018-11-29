<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'=>'Super Admin',
                'slug'=>'super-admin'
            ],
            [
                'name'=>'Admin',
                'slug'=>'admin',
            ],
            [
                'name'=>'Editor',
                'slug'=>'editor'
            ],
            [
                'name'=>'User',
                'slug'=>'user'
            ]
        ];

        foreach ($roles as $role) {
            Role::create([
                'name'=>$role['name'],
                'slug'=>$role['slug'],
            ]);
        }
    }
}
