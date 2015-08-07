<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(HomeTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(ProfileTableSeeder::class);

        // factory('App\User', 50)->create()->each(function($u) 
        // {
        //     $u->posts()->save(factory('App\Post')->make());
        // });

        // factory('App\Event', 50)->create()->each(function($u) 
        // {
        //     $u->posts()->save(factory('App\Post')->make());
        // });


        Model::reguard();
    }
}
