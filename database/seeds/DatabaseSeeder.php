<?php

use App\Laravue\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Laravue\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@laravue.dev',
            'password' => Hash::make('laravue'),
            'status' => '1',
            'verified' => '1',
        ]);
        $manager = User::create([
            'first_name' => 'Manager',
            'last_name' => 'Manager',
            'email' => 'manager@laravue.dev',
            'password' => Hash::make('laravue'),
            'status' => '1',
            'verified' => '1',
        ]);
        $editor = User::create([
            'first_name' => 'Editor',
            'last_name' => 'Editor',
            'email' => 'editor@laravue.dev',
            'password' => Hash::make('laravue'),
            'status' => '1',
            'verified' => '1',
        ]);
        $user = User::create([
            'first_name' => 'User',
            'last_name' => 'User',
            'email' => 'user@laravue.dev',
            'password' => Hash::make('laravue'),
            'status' => '1',
            'verified' => '1',
        ]);
        $visitor = User::create([
            'first_name' => 'Visitor',
            'last_name' => 'Visitor',
            'email' => 'visitor@laravue.dev',
            'password' => Hash::make('laravue'),
            'status' => '1',
            'verified' => '1',
        ]);

       \App\Laravue\Models\Setting::create([
            'share_rate' => '1000',
            'membership_fee' => '5000',
            'is_active' => 1,
        ]);

        $adminRole = Role::findByName(\App\Laravue\Acl::ROLE_ADMIN);
        $managerRole = Role::findByName(\App\Laravue\Acl::ROLE_MANAGER);
        $editorRole = Role::findByName(\App\Laravue\Acl::ROLE_EDITOR);
        $userRole = Role::findByName(\App\Laravue\Acl::ROLE_USER);
        $visitorRole = Role::findByName(\App\Laravue\Acl::ROLE_VISITOR);
        $admin->syncRoles($adminRole);
        $manager->syncRoles($managerRole);
        $editor->syncRoles($editorRole);
        $user->syncRoles($userRole);
        $visitor->syncRoles($visitorRole);
        //$this->call(UsersTableSeeder::class);
        $this->call(MembershipPermission::class);
        $this->call(RegionSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(BarangaySeeder::class);

    }
}
