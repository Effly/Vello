<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = json_decode(file_get_contents('D:\op\OSPanel\domains\parse\resultsFolder\HydraulicPumpDrive.json'), true);

        foreach ($products as $product) {
            foreach ($product as $keys) {
                foreach ($keys as $key ) {

                    DB::table('catalogs')->insert([
                        'name_first' => $key['title:'],
                    ]);
                }
            }
        }


    }
}
