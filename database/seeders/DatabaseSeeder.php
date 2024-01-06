<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\StatusEnum;
use App\Models\Avatar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(3)->create();


        $users[] = \App\Models\User::factory()->create([
            'name' => 'Sercan Sever',
            'email' => 'sercan@localkod.com',
            'password' => Hash::make(passwordGeneration(password: "123456")), // password
            'status' => StatusEnum::PASSIVE,
        ]);

        foreach ($users as $user) {
            Avatar::query()->create([
                'user_id' => $user?->id,
            ]);
        }
    }
}
