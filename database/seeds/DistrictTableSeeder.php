<?php

use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usrdst')->insert([
            array(
            	'dst' => 'Dhaka',
            	'dvnid' => '1',
            ),
            array(
            	'dst' => 'Narayangonj',
            	'dvnid' => '1',
            ),
            array(
            	'dst' => 'Gazipur',
            	'dvnid' => '1',
            ),
            array(
            	'dst' => 'Tangail',
            	'dvnid' => '1',
            ),
            array(
            	'dst' => 'Kishoregonj',
            	'dvnid' => '1',
            ),
            array(
            	'dst' => 'Narsingdi',
            	'dvnid' => '1',
            ),
            array(
            	'dst' => 'Gopalgonj',
            	'dvnid' => '1',
            ),
            array(
            	'dst' => 'Faridpur',
            	'dvnid' => '1',
            ),
            array(
            	'dst' => 'Jessore',
            	'dvnid' => '6',
            ),
            array(
            	'dst' => 'Satkhira',
            	'dvnid' => '6',
            ),
        ]);
    }
}
