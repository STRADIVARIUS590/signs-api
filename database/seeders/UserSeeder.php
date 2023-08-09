<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $u = User::create([
            'name' => 'Joel',
            'email' => 'joel@example.com',
            'password' => bcrypt('1235'),
        ]);

        $u->categories()->attach(1, ['score' => 3]);
        $u->categories()->attach(2, ['score' => 7]);


    }
}
