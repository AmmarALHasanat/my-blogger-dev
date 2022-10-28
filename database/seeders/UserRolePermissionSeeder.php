<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{

    protected array $roles = ['user'];

    public function run()
    {
        $this->createRoles();
    }

    protected function createRoles()
    {
        foreach ($this->roles as $role) {
            Role::updateOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
    }
}
