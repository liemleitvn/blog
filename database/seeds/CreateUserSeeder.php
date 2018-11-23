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
        $faker = Faker\Factory::create();

        for ($i = 0; $i<10; $i++) {
            User::created([
                'name'=>$faker->name,
                'email'=>$faker->unique()->email,
                'password'=>123456
            ]);
        }
    }
}
