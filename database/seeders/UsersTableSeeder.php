<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Amir', 'email' => 'amir@gmail.com', 'password' => '12345'],
            ['name' => 'Sohel', 'email' => 'sohel@gmail.com', 'password' => '345'],
            ['name' => 'Akash', 'email' => 'akash@gmail.com', 'password' => '78945612'],
        ];
        User::insert($users);
    }
}
