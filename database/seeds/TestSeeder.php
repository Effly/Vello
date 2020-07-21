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
        $categories = json_decode(file_get_contents('D:\op\OSPanel\domains\parse\resultsFolder\Categories.json'), true);
            foreach ($categories as $category) {
                foreach ($category as $item => $link) {

                    if (stristr($link,"/product_list/zapchasti-pogruzchikov/okhlazhdeniye-pogruzchika/")){
                        DB::table('categories')->insert([
                            'parent_id' => 6,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/tormoznaya-sistema/")) {
                        DB::table('categories')->insert([
                            'parent_id' => 7,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/transmissiya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 8,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/filtry/")){
                        DB::table('categories')->insert([
                            'parent_id' => 9,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/gidravlika/")){
                        DB::table('categories')->insert([
                            'parent_id' => 10,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/elektrooborudovanie-pogruzchika/")){
                        DB::table('categories')->insert([
                            'parent_id' => 11,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/veduschii-most/")){
                        DB::table('categories')->insert([
                            'parent_id' => 12,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/most-upravlyaemyy/")){
                        DB::table('categories')->insert([
                            'parent_id' => 13,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/rulevoe-upravlenie/")){
                        DB::table('categories')->insert([
                            'parent_id' => 14,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/kabiny-organy-upravleniya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 15,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/vykhlopnaya-sistema/")){
                        DB::table('categories')->insert([
                            'parent_id' => 16,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/gazovoe-oborudovanie/")){
                        DB::table('categories')->insert([
                            'parent_id' => 17,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/machta-pogruzchika/")){
                        DB::table('categories')->insert([
                            'parent_id' => 18,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/navesnoe-oborudovanie/")){
                        DB::table('categories')->insert([
                            'parent_id' => 19,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/osveshchenie/")){
                        DB::table('categories')->insert([
                            'parent_id' => 20,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/standartnye-detali-pogruzchikov/")){
                        DB::table('categories')->insert([
                            'parent_id' => 21,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-pogruzchikov/drugie-zapchasti/")){
                        DB::table('categories')->insert([
                            'parent_id' => 22,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/krivoshipno-shatunnyy-mekhanizm/")){
                        DB::table('categories')->insert([
                            'parent_id' => 23,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/gazoraspredelitelnyy-mekhanizm/")){
                        DB::table('categories')->insert([
                            'parent_id' => 24,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/sistema-okhlazhdeniya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 25,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/sistema-pitaniya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 26,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/sistema-vpuska/")){
                        DB::table('categories')->insert([
                            'parent_id' => 27,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/sistema-smazki/")){
                        DB::table('categories')->insert([
                            'parent_id' => 28,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/elektrooborudovanie-dvigatelya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 29,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/prokladki-dvigatelya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 30,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/privod-gidronasosa-dvigatelya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 31,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/korpusnye-detali-dvigatelya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 32,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/maslo-avtokhimiya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 33,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dvigateley/standartnye-detali-dvigateley/")){
                        DB::table('categories')->insert([
                            'parent_id' => 34,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/shiny-diski/shiny-pnevmaticheskie/")){
                        DB::table('categories')->insert([
                            'parent_id' => 35,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/shiny-diski/shiny-tselnolitye/")){
                        DB::table('categories')->insert([
                            'parent_id' => 36,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/shiny-diski/diski-kolyesnye/")){
                        DB::table('categories')->insert([
                            'parent_id' => 37,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/shiny-diski/kolesa-skladskoy-tekhniki/")){
                        DB::table('categories')->insert([
                            'parent_id' => 38,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/shiny-diski/tsepi-protivoskolzheniya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 39,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/tsilindry/")){
                        DB::table('categories')->insert([
                            'parent_id' => 40,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/zapchasti-k-tsilindram/")){
                        DB::table('categories')->insert([
                            'parent_id' => 41,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/salniki-i-koltsa/")){
                        DB::table('categories')->insert([
                            'parent_id' => 42,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/silovye-agregaty-i-zapchasti-k-nim/")){
                        DB::table('categories')->insert([
                            'parent_id' => 43,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/dvigateli-nasosy-i-zapchasti-k-nim/")){
                        DB::table('categories')->insert([
                            'parent_id' => 44,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/shlangi-i-fittingi/")){
                        DB::table('categories')->insert([
                            'parent_id' => 45,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/katushki-i-klapany/")){
                        DB::table('categories')->insert([
                            'parent_id' => 46,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/paltsy-vtulki-roliki/")){
                        DB::table('categories')->insert([
                            'parent_id' => 47,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/mekhanicheskie-uzly/")){
                        DB::table('categories')->insert([
                            'parent_id' => 48,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/pereklyuchateli-i-bloki-upravleniya/")){
                        DB::table('categories')->insert([
                            'parent_id' => 49,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/kabeli-i-razemy/")){
                        DB::table('categories')->insert([
                            'parent_id' => 50,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/elektricheskie-uzly/")){
                        DB::table('categories')->insert([
                            'parent_id' => 51,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    } elseif(stristr($link,"/product_list/zapchasti-dlya-gidrobortov/prochie-zapchasti/")){
                        DB::table('categories')->insert([
                            'parent_id' => 52,
                            'name' => $item,
                            'seo'=>1,
                            'desc'=>1

                        ]);
                    }

                }
            }
//            elseif ($category == 'subCategories') {
//                foreach ($values as $value => $link) {
//
//                    DB::table('categories')->insert([
//                        'parent_id' => 1,
//                        'name' => $value,
//                        'seo'=>1,
//                        'desc'=>1
//
//                    ]);
//                }
//            } elseif ($category == 'thirdCategories') {
//                foreach ($values as $value => $link) {
//
//                    DB::table('categories')->insert([
//                        'parent_id' => 2,
//                        'name' => $value,
//                        'seo'=>1,
//                        'desc'=>1
//
//                    ]);
//                }
//
//
//            }
        }

}
