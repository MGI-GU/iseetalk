<?php

use Illuminate\Database\Seeder;

class PermisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            'USER',
            'PROJECT',
            'AUDIO',
            'CHANNEL',
            'CATEGORY',
            'ROLE',
            'MEMBER',
            'TEAM',
            'PAGE',
            'COMMENT',
            'VISUAL'
        );
        $functions = array(
            'VIEW',
            'CREATE',
            'UPDATE',
            'DELETE',
            'AUDIT'
        );
        foreach ($data as $menu) {
            foreach ($functions as $action) {
                \App\Models\Permission::create([
                    'name' => $action. ' ' .$menu
                ]);
            }
        }
        \App\Models\Permission::create(['name' => 'UPDATE SETTING']);
        \App\Models\Permission::create(['name' => 'VIEW DASHBOARD']);
        // DB::table('permissions')->insert($data);
    }
}
