<?php

use Illuminate\Database\Seeder;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usrdvn')->insert([
            array(
            	'dvn' => 'Dhaka',
            	'cntid' => 1,
            ),
            array(
            	'dvn' => 'Rajshahi',
            	'cntid' => 1,
            ),
            array(
            	'dvn' => 'Chittagong',
            	'cntid' => 1,
            ),
            array(
            	'dvn' => 'Rangpur',
            	'cntid' => 1,
            ),
            array(
            	'dvn' => 'Barisal',
            	'cntid' => 1,
            ),
            array(
            	'dvn' => 'Khulna',
            	'cntid' => 1,
            ),
            array(
            	'dvn' => 'Mymensing',
            	'cntid' => 1,
            ),
            array(
            	'dvn' => 'Sylhet',
            	'cntid' => 1,
            ),
        ]);
    }
}
