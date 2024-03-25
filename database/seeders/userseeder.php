<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;


class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit doctor']);
        Permission::create(['name' => 'delete doctor']);
        Permission::create(['name' => 'create doctor']);
        Permission::create(['name' => 'view doctor']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'hdoc']);
        $role1->givePermissionTo('edit doctor');
        $role1->givePermissionTo('delete doctor');

        $role2 = Role::create(['name' => 'cos']);
        $role2->givePermissionTo('view doctor');
        $role2->givePermissionTo('create doctor');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'admindoctor',
            'email' => 'doc@whms.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@whms.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'sudo',
            'email' => 'superadmin@whms.com',
        ]);
        $user->assignRole($role3);
    }

}
