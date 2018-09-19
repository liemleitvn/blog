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
        $author = Role::create([
        	'name'=>'Author',
        	'slug'=>'author',
        	'permissions'=>[
        		'post.create'=>true,
        	]
        ]);
        $Editer = Role::create([
        	'name'=>'Editer',
        	'slug'=>'editer',
        	'permissions'=>[
        		'post.update'=>true,
        		'post.publish'=>true,
        	]
        ]);
    }
}
