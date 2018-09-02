<?php

use Illuminate\Database\Seeder;

class ThanaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('usrthn')->insert([
            array(
                'thn' => 'Ramna',
                'dstid' => '1',
            ),
            array(
                'thn' => 'Dhanmondi',
                'dstid' => '1',
            ),
            array(
                'thn' => 'Satkhira',
                'dstid' => '10',
            ),
            array(
                'thn' => 'Kalaroa',
                'dstid' => '10',
            ),
        ]);
        
    }
}
