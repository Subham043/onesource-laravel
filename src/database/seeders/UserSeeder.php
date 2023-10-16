<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Modules\Authentication\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //permission for dashboard
        Permission::create(['name' => 'view dashboard']);

        //permission for roles
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'add roles']);
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);

        //permission for users
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);

        //permission for customers
        Permission::create(['name' => 'edit customers']);
        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'view customers']);

        //permission for tools
        Permission::create(['name' => 'edit tools']);
        Permission::create(['name' => 'delete tools']);
        Permission::create(['name' => 'add tools']);
        Permission::create(['name' => 'list tools']);
        Permission::create(['name' => 'view tools']);

        //permission for clients
        Permission::create(['name' => 'edit clients']);
        Permission::create(['name' => 'delete clients']);
        Permission::create(['name' => 'add clients']);
        Permission::create(['name' => 'list clients']);
        Permission::create(['name' => 'view clients']);

        //permission for events
        Permission::create(['name' => 'edit events']);
        Permission::create(['name' => 'delete events']);
        Permission::create(['name' => 'add events']);
        Permission::create(['name' => 'list events']);
        Permission::create(['name' => 'view events']);

        //permission for calendar
        Permission::create(['name' => 'view calendar']);

        //permission for reports
        Permission::create(['name' => 'view reports']);

        //permission for exports
        Permission::create(['name' => 'view exports']);

        //permission for quickbook
        Permission::create(['name' => 'view quickbook']);

        //permission for conflicts
        Permission::create(['name' => 'view conflicts']);
        Permission::create(['name' => 'resolve conflicts']);

        //permission for documents
        Permission::create(['name' => 'download documents']);
        Permission::create(['name' => 'delete documents']);
        Permission::create(['name' => 'add documents']);
        Permission::create(['name' => 'list documents']);

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['name' => 'Super-Admin']);

        // create roles and assign created permissions
        $admin_role = Role::create(['name' => 'Super Admin'])
            ->givePermissionTo([

                //permission for customers
                'edit customers',
                'list customers',
                'view customers',
            ]);

        // create roles and assign created permissions
        Role::create(['name' => 'Admin'])
            ->givePermissionTo([

                //permission for dashboard
                'view dashboard',

                //permission for users
                'edit users',
                'delete users',
                'add users',
                'list users',
                'view users',

                //permission for tools
                'edit tools',
                'delete tools',
                'add tools',
                'list tools',
                'view tools',

                //permission for clients
                'edit clients',
                'delete clients',
                'add clients',
                'list clients',
                'view clients',

                //permission for events
                'edit events',
                'delete events',
                'add events',
                'list events',
                'view events',

                //permission for calendar
                'view calendar',

                //permission for reports
                'view reports',

                //permission for exports
                'view exports',

                //permission for quickbook
                'view quickbook',

                //permission for conflicts
                'view conflicts',
                'resolve conflicts',

                //permission for documents
                'download documents',
                'delete documents',
                'add documents',
                'list documents',

            ]);

        // create roles and assign created permissions
        Role::create(['name' => 'Staff-Admin'])
            ->givePermissionTo([

                //permission for dashboard
                'view dashboard',

                //permission for users
                'edit users',
                'delete users',
                'add users',
                'list users',
                'view users',

                //permission for tools
                'edit tools',
                'delete tools',
                'add tools',
                'list tools',
                'view tools',

                //permission for clients
                'edit clients',
                'delete clients',
                'add clients',
                'list clients',
                'view clients',

                //permission for events
                'edit events',
                'delete events',
                'add events',
                'list events',
                'view events',

                //permission for calendar
                'view calendar',

                //permission for reports
                'view reports',

                //permission for exports
                'view exports',

                //permission for quickbook
                'view quickbook',

                //permission for conflicts
                'view conflicts',
                'resolve conflicts',

                //permission for documents
                'download documents',
                'delete documents',
                'add documents',
                'list documents',

            ]);

        Role::create(['name' => 'Writer'])
            ->givePermissionTo([

                //permission for dashboard
                'view dashboard',

                //permission for events
                'list events',
                'view events',

                //permission for calendar
                'view calendar',

                //permission for documents
                'download documents',
                'delete documents',
                'add documents',
                'list documents',

            ]);

        Role::create(['name' => 'Client'])
            ->givePermissionTo([

                //permission for dashboard
                'view dashboard',

                //permission for events
                'list events',
                'view events',

                //permission for calendar
                'view calendar',

                //permission for documents
                'download documents',

            ]);

        // create User with Super Admin Role
        User::factory()->create([
            'name' => 'Subham Saha',
            'email' => 'subham.5ine@gmail.com',
            'phone' => '7892156160',
            'password' => 'subham',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ])->assignRole($admin_role);

    }
}
