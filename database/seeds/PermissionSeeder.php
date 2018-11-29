<?php

use Illuminate\Database\Seeder;

use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'read category'=>'read-category',
            'create category'=>'create-category',
            'update category'=>'update-category',
            'delete category'=>'delete-category',
            'read post'=>'read-post',
            'create post'=>'create-post',
            'update post'=>'update-post',
            'delete post'=>'delete-post'
        ];

        foreach ($permissions as $key=>$permission) {
            Permission::create([
                'name'=>$key,
                'slug'=>$permission
            ]);
        }
    }
}
