<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@amatrung.com'],
            [
                'name' => 'Admin AmaTrung',
                'phone' => '0900000001',
                'date_of_birth' => '1990-01-01',
                'gender' => 'female',
                'password' => Hash::make('12345678'),
                'status' => 1,
            ]
        );

        $staff = User::updateOrCreate(
            ['email' => 'staff@amatrung.com'],
            [
                'name' => 'Nhân viên AmaTrung',
                'phone' => '0900000002',
                'date_of_birth' => '1998-01-01',
                'gender' => 'female',
                'password' => Hash::make('12345678'),
                'status' => 1,
            ]
        );

        $userRole = Role::where('name', 'user')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $staffRole = Role::where('name', 'staff')->first();

        $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        $staff->roles()->syncWithoutDetaching([$staffRole->id]);

        $demoUser = User::updateOrCreate(
            ['email' => 'user@amatrung.com'],
            [
                'name' => 'Người dùng AmaTrung',
                'phone' => '0900000003',
                'date_of_birth' => '2004-01-01',
                'gender' => 'female',
                'password' => Hash::make('12345678'),
                'status' => 1,
            ]
        );

        $demoUser->roles()->syncWithoutDetaching([$userRole->id]);
    }
}
