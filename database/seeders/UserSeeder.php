<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 2,
                'name' => 'Edwin Alexander Tobias',
                'email' => 'edwintobas79@gmail.com',
                'password' => '$2y$10$rrvbPk0QevEkZpP6s1l0B.3Et3JSf4Ui.rZQmjVr6qkoNDXfXWE6C',
            ],
            [
                'id' => 3,
                'name' => 'Francisco Javier Tobias',
                'email' => 'javyxmusic@gmail.com',
                'password' => '$2y$10$2yJnUuBGc6mufXVLLOPvwOvmgI9951hcbkYkWdjGetq6HQzBBil.S',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['id' => $user['id']], $user);
        }
    }
}
