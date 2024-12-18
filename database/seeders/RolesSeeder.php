<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole    = Role::firstOrCreate(['name' => 'Admin']);
        $employeeRole = Role::firstOrCreate(['name' => 'Employee']);

        $adminPermissions = [
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

        $employeePermissions = ['update invoice'];

        $adminRole->syncPermissions($adminPermissions);
        $employeeRole->syncPermissions($employeePermissions);

    }
}
