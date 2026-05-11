<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        foreach (UserRoleEnum::cases() as $role) {
            Role::firstOrCreate(['name' => $role->value]);
        }

        // Create a default Super Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@docnest.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole(UserRoleEnum::SUPER_ADMIN->value);
    }
}
