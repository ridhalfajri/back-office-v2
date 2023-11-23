<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class BasicAdminPermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        $permissions = [
            'dashboard',
            'pegawai',
            'unit_kerja',
            'pengaturan',
            'master',
            'hirarki_unit_kerja_list',
            'hirarki_unit_kerja_create',
            'hirarki_unit_kerja_edit',
            'hirarki_unit_kerja_delete',
            'gaji_list',
            'gaji_create',
            'gaji_edit',
            'gaji_delete',
            'jabatan_tukin_list',
            'jabatan_tukin_create',
            'jabatan_tukin_edit',
            'jabatan_tukin_delete',
            'jabatan_unit_kerja_list',
            'jabatan_unit_kerja_create',
            'jabatan_unit_kerja_edit',
            'jabatan_unit_kerja_delete',
            'pegawai_list',
            'pegawai_create',
            'pegawai_edit',
            'pegawai_delete',
            'alamat_pegawai_list',
            'alamat_pegawai_create',
            'alamat_pegawai_edit',
            'alamat_pegawai_delete',
            'riwayat_diklat_list',
            'riwayat_diklat_create',
            'riwayat_diklat_edit',
            'riwayat_diklat_delete',
            'tmt_gaji_list',
            'tmt_gaji_create',
            'tmt_gaji_edit',
            'tmt_gaji_delete',
            'riwayat_pendidikan_list',
            'riwayat_pendidikan_create',
            'riwayat_pendidikan_edit',
            'riwayat_pendidikan_delete',
            'anak_list',
            'anak_create',
            'anak_edit',
            'anak_delete',
            'suami_istri_list',
            'suami_istri_create',
            'suami_istri_edit',
            'suami_istri_delete',
            'saldo_cuti_list',
            'saldo_cuti_create',
            'saldo_cuti_edit',
            'saldo_cuti_delete',
            'tunjangan_kinerja_list',
            'tunjangan_kinerja_create',
            'tunjangan_kinerja_edit',
            'tunjangan_kinerja_delete',
            'uang_makan_list',
            'uang_makan_create',
            'uang_makan_edit',
            'uang_makan_delete',
            'hari_libur_list',
            'hari_libur_create',
            'hari_libur_edit',
            'hari_libur_delete',
            'hak_akses_list',
            'hak_akses_create',
            'hak_akses_edit',
            'hak_akses_delete',
            'role_list',
            'role_create',
            'role_edit',
            'role_delete',
            'pengguna_list',
            'pengguna_create',
            'pengguna_edit',
            'pengguna_delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('dashboard');
        $role1->givePermissionTo('pegawai');
        $role1->givePermissionTo('unit_kerja');
        $role1->givePermissionTo('master');
        $role1->givePermissionTo('pengaturan');
        $role1->givePermissionTo('hak_akses_list');
        $role1->givePermissionTo('hak_akses_create');
        $role1->givePermissionTo('hak_akses_edit');
        $role1->givePermissionTo('hak_akses_delete');

        $role1->givePermissionTo('role_list');
        $role1->givePermissionTo('role_create');
        $role1->givePermissionTo('role_edit');
        $role1->givePermissionTo('role_delete');

        $role1->givePermissionTo('pengguna_list');
        $role1->givePermissionTo('pengguna_create');
        $role1->givePermissionTo('pengguna_edit');
        $role1->givePermissionTo('pengguna_delete');


        $role2 = Role::create(['name' => 'pegawai']);
        $role2->givePermissionTo('dashboard');
        $role2->givePermissionTo('pegawai');
        $role2->givePermissionTo('gaji_list');
        $role2->givePermissionTo('gaji_create');
        $role2->givePermissionTo('gaji_edit');
        $role2->givePermissionTo('gaji_delete');

        $role2->givePermissionTo('pegawai_list');
        $role2->givePermissionTo('pegawai_create');
        $role2->givePermissionTo('pegawai_edit');
        $role2->givePermissionTo('pegawai_delete');

        $role3 = Role::create(['name' => 'super-admin']);
        foreach ($permissions as $permission) {
            $role3->givePermissionTo($permission);
        }
        // // gets all permissions via Gate::before rule; see AuthServiceProvider
        // // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('@Bsn2023'),
        ]);
        $user->assignRole($role3);


        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => bcrypt('@Bsn2023'),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@mail.com',
            'password' => bcrypt('@Bsn2023'),
        ]);
        $user->assignRole($role2);
    }
}
