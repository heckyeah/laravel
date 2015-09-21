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

        for($i=0;$i<100;$i++) {
            $this->call(UserTableSeeder::class);
        }

        // for($i=0;$i<10;$i++) {
        //     $this->call(WorkphoneTableSeeder::class);
        // }

        Model::reguard();
    }
}
