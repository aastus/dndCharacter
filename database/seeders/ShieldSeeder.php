<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        // Clear any cached permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define roles and permissions
        $rolesWithPermissions = '[{
            "name": "super_admin",
            "guard_name": "web",
            "permissions": [
                "view_ability", "view_any_ability", "create_ability", "update_ability", "restore_ability", "restore_any_ability",
                "replicate_ability", "reorder_ability", "delete_ability", "delete_any_ability", "force_delete_ability", "force_delete_any_ability",

                "view_alignment", "view_any_alignment", "create_alignment", "update_alignment", "restore_alignment", "restore_any_alignment",
                "replicate_alignment", "reorder_alignment", "delete_alignment", "delete_any_alignment", "force_delete_alignment", "force_delete_any_alignment",

                "view_background", "view_any_background", "create_background", "update_background", "restore_background", "restore_any_background",
                "replicate_background", "reorder_background", "delete_background", "delete_any_background", "force_delete_background", "force_delete_any_background",

                "view_character", "view_any_character", "create_character", "update_character", "restore_character", "restore_any_character",
                "replicate_character", "reorder_character", "delete_character", "delete_any_character", "force_delete_character", "force_delete_any_character",

                "view_characteristic", "view_any_characteristic", "create_characteristic", "update_characteristic", "restore_characteristic", "restore_any_characteristic",
                "replicate_characteristic", "reorder_characteristic", "delete_characteristic", "delete_any_characteristic", "force_delete_characteristic", "force_delete_any_characteristic",

                "view_class::model", "view_any_class::model", "create_class::model", "update_class::model", "restore_class::model", "restore_any_class::model",
                "replicate_class::model", "reorder_class::model", "delete_class::model", "delete_any_class::model", "force_delete_class::model", "force_delete_any_class::model",

                "view_language", "view_any_language", "create_language", "update_language", "restore_language", "restore_any_language",
                "replicate_language", "reorder_language", "delete_language", "delete_any_language", "force_delete_language", "force_delete_any_language",

                "view_proficiency", "view_any_proficiency", "create_proficiency", "update_proficiency", "restore_proficiency", "restore_any_proficiency",
                "replicate_proficiency", "reorder_proficiency", "delete_proficiency", "delete_any_proficiency", "force_delete_proficiency", "force_delete_any_proficiency",

                "view_race", "view_any_race", "create_race", "update_race", "restore_race", "restore_any_race",
                "replicate_race", "reorder_race", "delete_race", "delete_any_race", "force_delete_race", "force_delete_any_race",

                "view_role", "view_any_role", "create_role", "update_role", "delete_role", "delete_any_role",

                "view_spell", "view_any_spell", "create_spell", "update_spell", "restore_spell", "restore_any_spell",
                "replicate_spell", "reorder_spell", "delete_spell", "delete_any_spell", "force_delete_spell", "force_delete_any_spell",

                "view_user", "view_any_user", "create_user", "update_user", "restore_user", "restore_any_user",
                "replicate_user", "reorder_user", "delete_user", "delete_any_user", "force_delete_user", "force_delete_any_user",

                "view_weapon", "view_any_weapon", "create_weapon", "update_weapon", "restore_weapon", "restore_any_weapon",
                "replicate_weapon", "reorder_weapon", "delete_weapon", "delete_any_weapon", "force_delete_weapon", "force_delete_any_weapon"
            ]
        }]';

        $directPermissions = '[]';

        // Seed roles with permissions
        $this->makeRolesWithPermissions($rolesWithPermissions);
        $this->makeDirectPermissions($directPermissions);

        // Create Super Admin User and assign role
        $this->createSuperAdmin();

        $rolesWithPermissions2 = '[{
            "name": "panel_user",
            "guard_name": "web",
            "permissions": [
                "view_character", "view_any_character", "create_character", "update_character", "restore_character", "restore_any_character",
                "replicate_character", "reorder_character", "delete_character", "delete_any_character", "force_delete_character", "force_delete_any_character",
            ]
        }]';
        $this->makeRolesWithPermissions($rolesWithPermissions2);
        $this->makeDirectPermissions($directPermissions);
        $this->command->info('Shield Seeding Completed.');
    }

    protected function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        $rolePermissionsArray = json_decode($rolesWithPermissions, true);

        if (!empty($rolePermissionsArray)) {
            foreach ($rolePermissionsArray as $roleWithPermission) {
                // Create or retrieve the role
                $role = Role::firstOrCreate([
                    'name' => $roleWithPermission['name'],
                    'guard_name' => $roleWithPermission['guard_name'],
                ]);

                // Create permissions if they don't exist and assign them to the role
                if (!empty($roleWithPermission['permissions'])) {
                    $permissions = collect($roleWithPermission['permissions'])->map(function ($permissionName) use ($roleWithPermission) {
                        return Permission::firstOrCreate([
                            'name' => $permissionName,
                            'guard_name' => $roleWithPermission['guard_name'],
                        ]);
                    });

                    // Sync permissions with the role
                    $role->syncPermissions($permissions);
                    $this->command->info($role->name);
                }
            }
        }
    }

    protected function makeDirectPermissions(string $directPermissions): void
    {
        $permissionsArray = json_decode($directPermissions, true);

        if (!empty($permissionsArray)) {
            foreach ($permissionsArray as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission['name'],
                    'guard_name' => $permission['guard_name'],
                ]);
            }
        }
    }

    protected function createSuperAdmin()
    {
        $superAdminEmail = 'admin@admin.com';
        $superAdminPassword = 'admin';

        // Create the super_admin role if it doesn't exist
        $role = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        // Create or retrieve the super admin user
        $user = User::firstOrCreate(
            ['email' => $superAdminEmail],
            [
                'name' => 'Super Admin',
                'password' => Hash::make($superAdminPassword),
            ]
        );

        // Assign the super_admin role to the user
        $user->assignRole($role);
    }
}
