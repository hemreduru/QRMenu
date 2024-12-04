<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abilities = [
            'okuma',
            'yazma',
            'oluşturma',
        ];

        $permissions_by_role = [
            'administrator' => [
                'kullanıcı yönetimi',
                'içerik yönetimi',
                'finansal yönetim',
                'raporlama',
                'bordro',
                'ihtilaf yönetimi',
                'api kontrolleri',
                'veritabanı yönetimi',
                'depo yönetimi',
            ],
            'developer' => [
                'api kontrolleri',
                'veritabanı yönetimi',
                'depo yönetimi',
            ],
            'analyst' => [
                'içerik yönetimi',
                'finansal yönetim',
                'raporlama',
                'bordro',
            ],
            'support' => [
                'raporlama',
            ],
            'trial' => [],
        ];

        foreach ($permissions_by_role['administrator'] as $permission) {
            foreach ($abilities as $ability) {
                Permission::create(['name' => $ability . ' ' . $permission]);
            }
        }

        foreach ($permissions_by_role as $role => $permissions) {
            $full_permissions_list = [];
            foreach ($abilities as $ability) {
                foreach ($permissions as $permission) {
                    $full_permissions_list[] = $ability . ' ' . $permission;
                }
            }
            Role::create(['name' => $role])->syncPermissions($full_permissions_list);
        }

        User::find(1)->assignRole('administrator');
        User::find(2)->assignRole('developer');
    }
}
