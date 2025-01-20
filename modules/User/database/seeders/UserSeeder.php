<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);

        if(!User::count()){
            User::factory(10)->create();
        }

        else{
            die("Error ::: Cannot seed a populated table ");
        }
    }
}
