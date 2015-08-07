<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('event')->insert([
            'name' => str_random(10),
            'location' => str_random(10).'@gmail.com',
        ]);
    }
}
