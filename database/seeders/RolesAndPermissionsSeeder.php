<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Model\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $createPermission = Permission::create(['name' => 'create listing']);
        $editPermission = Permission::create(['name' => 'edit listing']);
        $updatePermission = Permission::create(['name' => 'update listing']);
        $deletePermission = Permission::create(['name' => 'delete listing']);

        $admin->givePermissionTo($createPermission, $editPermission, $updatePermission, $deletePermission);
        
    }
}
