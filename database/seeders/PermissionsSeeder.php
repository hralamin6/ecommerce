<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list paymentmethods']);
        Permission::create(['name' => 'view paymentmethods']);
        Permission::create(['name' => 'create paymentmethods']);
        Permission::create(['name' => 'update paymentmethods']);
        Permission::create(['name' => 'delete paymentmethods']);

        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'list allproducts']);
        Permission::create(['name' => 'view allproducts']);
        Permission::create(['name' => 'create allproducts']);
        Permission::create(['name' => 'update allproducts']);
        Permission::create(['name' => 'delete allproducts']);

        Permission::create(['name' => 'list sliders']);
        Permission::create(['name' => 'view sliders']);
        Permission::create(['name' => 'create sliders']);
        Permission::create(['name' => 'update sliders']);
        Permission::create(['name' => 'delete sliders']);

        Permission::create(['name' => 'list allbanners']);
        Permission::create(['name' => 'view allbanners']);
        Permission::create(['name' => 'create allbanners']);
        Permission::create(['name' => 'update allbanners']);
        Permission::create(['name' => 'delete allbanners']);

        Permission::create(['name' => 'list allcoupons']);
        Permission::create(['name' => 'view allcoupons']);
        Permission::create(['name' => 'create allcoupons']);
        Permission::create(['name' => 'update allcoupons']);
        Permission::create(['name' => 'delete allcoupons']);

        Permission::create(['name' => 'list allreviews']);
        Permission::create(['name' => 'view allreviews']);
        Permission::create(['name' => 'create allreviews']);
        Permission::create(['name' => 'update allreviews']);
        Permission::create(['name' => 'delete allreviews']);

        Permission::create(['name' => 'list allorders']);
        Permission::create(['name' => 'view allorders']);
        Permission::create(['name' => 'create allorders']);
        Permission::create(['name' => 'update allorders']);
        Permission::create(['name' => 'delete allorders']);

        Permission::create(['name' => 'list allorderdetails']);
        Permission::create(['name' => 'view allorderdetails']);
        Permission::create(['name' => 'create allorderdetails']);
        Permission::create(['name' => 'update allorderdetails']);
        Permission::create(['name' => 'delete allorderdetails']);

        Permission::create(['name' => 'list allwishlists']);
        Permission::create(['name' => 'view allwishlists']);
        Permission::create(['name' => 'create allwishlists']);
        Permission::create(['name' => 'update allwishlists']);
        Permission::create(['name' => 'delete allwishlists']);

        Permission::create(['name' => 'list brands']);
        Permission::create(['name' => 'view brands']);
        Permission::create(['name' => 'create brands']);
        Permission::create(['name' => 'update brands']);
        Permission::create(['name' => 'delete brands']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'terms conditions']);
        Permission::create(['name' => 'terms service']);
        Permission::create(['name' => 'privacy policy']);
        Permission::create(['name' => 'refund policy']);
        Permission::create(['name' => 'about us']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $users = \App\Models\User::all();
        foreach ($users as $user){
            $user->assignRole($userRole);
        }
        $user = \App\Models\User::first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
