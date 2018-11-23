<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Hash;
use Faker;
use DB;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:import'; //numberOfUser is number of User once execute

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command insert user to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        file_put_contents(storage_path('logs/abc.log'), "Test");
        die;
        $numberOfUser = $this->argument('numberOfUser');
        if($this->confirm('Are you sure create user ?')) {
            $faker = Faker\Factory::create();
            try {
                for ($i= 0; $i < $numberOfUser; $i ++ ){
                    DB::table('users')->insert([
                        'name'         => $faker->name,
                        'email'        => $faker->unique()->email,
                        'password'     =>  Hash::make('123456')
                    ]);
                }
                $this->info($numberOfUser. ' create success');
            } catch (\Exception $e) {
                $this->error('Error '. $e . ' when create user');
            }
        }
    }
}
