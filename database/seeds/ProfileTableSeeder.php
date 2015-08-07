<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('profile')->insert([
            'name' => str_random(10),
            'fk' => str_random(10),
        ]);
    }
}
