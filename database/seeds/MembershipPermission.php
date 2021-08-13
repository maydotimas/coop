<?php

use Illuminate\Database\Seeder;

class MembershipPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Laravue\Models\Permission::findOrCreate('view membership', 'api');
        \App\Laravue\Models\Permission::findOrCreate('manage membership', 'api');
        \App\Laravue\Models\Permission::findOrCreate('user membership', 'api');

        // Assign new permissions to user group
        $userRole = App\Laravue\Models\Role::findByName(App\Laravue\Acl::ROLE_ADMIN);
        $userRole->givePermissionTo(['view membership', 'manage membership']);

        $userRole = App\Laravue\Models\Role::findByName(App\Laravue\Acl::ROLE_USER);
        $userRole->givePermissionTo(['user membership']);
    }
}
