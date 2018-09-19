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
        $author = Role::where('slug', 'author')->first();
        $editor = Role::where('slug', 'editor')->first();
        
        $user1 = User::create([
            'name' => 'Author 1', 
            'email' => 'author1@blog.local',
            'password' => bcrypt('123456')
        ]);
        $user1->roles()->attach($author);
        
        $user2 = User::create([
            'name' => 'Author 1', 
            'email' => 'author2@blog.local',
            'password' => bcrypt('123456')
        ]);
        $user2->roles()->attach($author);
        
        $user3 = User::create([
            'name' => 'Editer 2', 
            'email' => 'editor1@blog.local',
            'password' => bcrypt('123456')
        ]);
        $user2->roles()->attach($editor);
    }
}
