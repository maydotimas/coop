<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('region')->delete();

        \DB::table('region')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'psgcCode' => '010000000',
                    'regDesc' => 'REGION I (ILOCOS REGION)',
                    'regCode' => 1,
                ),
            1 =>
                array (
                    'id' => 2,
                    'psgcCode' => '020000000',
                    'regDesc' => 'REGION II (CAGAYAN VALLEY)',
                    'regCode' => 2,
                ),
            2 =>
                array (
                    'id' => 3,
                    'psgcCode' => '030000000',
                    'regDesc' => 'REGION III (CENTRAL LUZON)',
                    'regCode' => 3,
                ),
            3 =>
                array (
                    'id' => 4,
                    'psgcCode' => '040000000',
                    'regDesc' => 'REGION IV-A (CALABARZON)',
                    'regCode' => 4,
                ),
            4 =>
                array (
                    'id' => 5,
                    'psgcCode' => '170000000',
                    'regDesc' => 'REGION IV-B (MIMAROPA)',
                    'regCode' => 17,
                ),
            5 =>
                array (
                    'id' => 6,
                    'psgcCode' => '050000000',
                    'regDesc' => 'REGION V (BICOL REGION)',
                    'regCode' => 5,
                ),
            6 =>
                array (
                    'id' => 7,
                    'psgcCode' => '060000000',
                    'regDesc' => 'REGION VI (WESTERN VISAYAS)',
                    'regCode' => 6,
                ),
            7 =>
                array (
                    'id' => 8,
                    'psgcCode' => '070000000',
                    'regDesc' => 'REGION VII (CENTRAL VISAYAS)',
                    'regCode' => 7,
                ),
            8 =>
                array (
                    'id' => 9,
                    'psgcCode' => '080000000',
                    'regDesc' => 'REGION VIII (EASTERN VISAYAS)',
                    'regCode' => 8,
                ),
            9 =>
                array (
                    'id' => 10,
                    'psgcCode' => '090000000',
                    'regDesc' => 'REGION IX (ZAMBOANGA PENINSULA)',
                    'regCode' => 9,
                ),
            10 =>
                array (
                    'id' => 11,
                    'psgcCode' => '100000000',
                    'regDesc' => 'REGION X (NORTHERN MINDANAO)',
                    'regCode' => 10,
                ),
            11 =>
                array (
                    'id' => 12,
                    'psgcCode' => '110000000',
                    'regDesc' => 'REGION XI (DAVAO REGION)',
                    'regCode' => 11,
                ),
            12 =>
                array (
                    'id' => 13,
                    'psgcCode' => '120000000',
                    'regDesc' => 'REGION XII (SOCCSKSARGEN)',
                    'regCode' => 12,
                ),
            13 =>
                array (
                    'id' => 14,
                    'psgcCode' => '130000000',
                    'regDesc' => 'NATIONAL CAPITAL REGION (NCR)',
                    'regCode' => 13,
                ),
            14 =>
                array (
                    'id' => 15,
                    'psgcCode' => '140000000',
                    'regDesc' => 'CORDILLERA ADMINISTRATIVE REGION (CAR)',
                    'regCode' => 14,
                ),
            15 =>
                array (
                    'id' => 16,
                    'psgcCode' => '150000000',
                    'regDesc' => 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)',
                    'regCode' => 15,
                ),
            16 =>
                array (
                    'id' => 17,
                    'psgcCode' => '160000000',
                    'regDesc' => 'REGION XIII (Caraga)',
                    'regCode' => 16,
                ),
        ));
    }
}
