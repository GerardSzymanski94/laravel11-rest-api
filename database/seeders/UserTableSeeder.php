<?php

namespace Database\Seeders;

use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@example.com',
        ],[
            'name' => 'Admin',
            'status' => UserStatusEnum::ADMIN,
            'password' => Hash::make('123qwe')
        ]);
        User::firstOrCreate([
            'email' => 'user@example.com',
        ],[
            'name' => 'User',
            'status' => UserStatusEnum::USER,
            'password' => Hash::make('qwe123')
        ]);
    }
}
