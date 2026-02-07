<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SystemUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, create or obtain the administrator user.
        $adminUser = $this->createAdminUser();
        
        // Create the system administrator user
        $systemUsers = [
            [
                'custom_id' => 'ADM001',
                'user_id' => $adminUser->id,
                'fname' => 'System',
                'lname' => 'Administrator',
                'email' => 'admin@nexorait.lk',
                'mobile' => '0711234567',
                'nic' => '123456789V',
                'bday' => '1985-01-15',
                'gender' => 'male',
                'address1' => 'Mirigama,Sri Lanka',
                'address2' => 'Nexora IT Solutions',
                'address3' => 'Mirigama',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Check if the administrator already exists.
        $existingAdmin = DB::table('system_users')
            ->where('email', 'admin@nexorait.lk')
            ->orWhere('custom_id', 'ADM001')
            ->first();

        if (!$existingAdmin) {
            DB::table('system_users')->insert($systemUsers);
            $this->command->info('✅ The system administrator user was successfully created!');
        } else {
            $this->command->info('ℹ️ The system administrator user already exists.');
        }
    }

    /**
     * Create the admin user in the users table.
     */
    private function createAdminUser()
    {
        // First, create or get the user_type for Admin in the user_types table.
        $adminType = DB::table('user_types')
            ->where('type', 'Admin')
            ->first();

        if (!$adminType) {
            $adminTypeId = DB::table('user_types')->insertGetId([
                'type' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $adminTypeId = $adminType->id;
        }

        // Create the administrator user account
        $adminUser = DB::table('users')
            ->where('email', 'admin@nexorait.lk')
            ->first();

        if (!$adminUser) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'System Administrator',
                'email' => 'admin@nexorait.lk',
                'password' => Hash::make('nexora'),
                'user_type' => $adminTypeId,
                'is_active' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            return (object)['id' => $userId];
        }

        return $adminUser;
    }
}