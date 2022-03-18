<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-show',
            'user-edit',
            'user-delete',
            'perm-list',
            'perm-create',
            'perm-delete',
            'perm-edit',
            'kitchen-cat-list',
            'kitchen-cat-create',
            'kitchen-cat-delete',
            'kitchen-cat-edit',
            'restaurant',


        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
