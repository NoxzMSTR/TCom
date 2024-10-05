<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AdminUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ammad Javed',
            'email' => 'ammadjaved8@gmail.com',
            'password' => Hash::make('Admin123$'),
        ]);

        User::create([
            'name' => 'Mohammad Azeem',
            'email' => 'buttazeem16@gmail.com',
            'password' => Hash::make('Admin123$'),
        ]);
    }
}
