<?php

use Illuminate\Database\Seeder;

class SuperAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('super_admin')->insert([
            'name' => 'Ruhul',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'phone' => '01638584622',
            'password' => md5('superadmin'),
        ]);
    }
}
