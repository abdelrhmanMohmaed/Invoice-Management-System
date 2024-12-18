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
        User::factory(20)->create();
        $permissions = [
            'create invoice',
            'update invoice',
            'delete invoice',
            'show customer',
            'create customer',
            'update customer',
            'delete customer',
            'show user',
            'create user',
            'update user',
            'delete user',
        ];

        User::create(
            [
                'email' => 'admin@admin.com',
                'name' => 'Admin User',
                'password' => 123456789
            ]
        )->syncRoles('admin')
            ->givePermissionTo($permissions);

        User::create(
            [
                'email' => 'employee@employee.com',
                'name' => 'Employee User',
                'password' => 123456789
            ]
        )->syncRoles('employee')
        ->givePermissionTo(['update invoice']);
    }
}
