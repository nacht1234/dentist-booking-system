<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@bahogoten.com'],
            [
                'name' => 'Bahog Oten',
                'password' => Hash::make('12341234'),
            ]
        );

        $admin->roles()->syncWithoutDetaching([$adminRole->id]);
    }
}
