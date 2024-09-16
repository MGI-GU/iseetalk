<?php

use Illuminate\Database\Seeder;

class PermisionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = \App\Models\Role::get();
        $permissions = \App\Models\Permission::get();

        foreach ($roles as $role) {
            foreach ($permissions as $permission) {
                \App\Models\PermissionRole::create([
                    'role_id' => $role->id,
                    'permission_id' => $permission->id
                ]);
            }
        }
    }
}
