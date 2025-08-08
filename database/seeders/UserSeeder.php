<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Khaled Mohamed',
            'email' => 'khaled@email.com',
            'phone' => '+201010101010',
            'type' => 'admin',
        ]);

        User::factory(10)->create();

    }
}
