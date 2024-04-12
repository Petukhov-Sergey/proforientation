<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Log; // Добавьте эту строку
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.org',
            'password' => bcrypt('Aa123456'),
        ]);
        Log::info("Creating user: {$user->name}"); // Теперь Log будет распознан
        $user->roles()->attach(1);
        Log::info("Attached role to user: {$user->name}"); // Теперь Log будет распознан
    }
}
