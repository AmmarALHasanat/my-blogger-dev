<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminRolePermissionSeeder extends Seeder
{

    protected array $roles = ['super-admin'];
    protected array $abilities = ['view-any','view', 'create', 'update', 'delete'];
    protected array $permissions = [''];
    protected array $resources = ['admin', 'role', 'permission','user'];


    public function run()
    {
        $this->createRoles();
        $this->createPermissions();
        //$this->assignPermissionsToRoles();
    }

    protected function createRoles()
    {
        foreach ($this->roles as $role) {
            Role::updateOrCreate(['name' => $role, 'guard_name' => 'admin']);
        }
        // or
        /*
        collect($this->roles)->each(function ($role) {
            Role::updateOrCreate(['name' => $role, 'guard_name' => 'admin']);
        });
        */
    }

    protected function createPermissions()
    {
        foreach ($this->resources as $resource) {
            foreach ($this->abilities as $ability) {
                Permission::updateOrCreate(['name' => $ability . '-' . $resource]);
            }
        }
    }

    protected function assignPermissionsToRoles()
    {
        Role::where('name', 'super-admin')
            ->first()
            ->givePermissionTo(Permission::all(), 'admin');
    }

}
