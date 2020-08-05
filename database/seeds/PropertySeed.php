<?php

use App\Categories;
use Illuminate\Database\Seeder;

class PropertySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = json_decode(file_get_contents('D:\op\OSPanel\domains\parse\resultsFolder\full.json'), true);
        foreach ($categories as $category) {
            foreach ($category as $items) {
                foreach ($items as $item) {

                    if ($item["secondSubcategory: "] != "") {
                        if ($item["thirdSubcategory: "] != "") {
                            for ($i = 6; $i <= 34; $i++) {
                                $catalogs = Categories::where('parent_id', $i)->get();
                                foreach ($catalogs as $catalog) {
                                    if ($item["thirdSubcategory: "] == $catalog->name) {


                                        DB::insert("insert ignore into propetites(cat_slug,brand) values (?,?)",[$catalog->slug,$item['brand:']]);

                                    }

                                }
                            }

                        } else {
                            for ($i = 1; $i <= 4; $i++) {
                                $catalogs = Categories::where('parent_id', '=', $i)->get();
                                foreach ($catalogs as $catalog) {
                                    if ($item["secondSubcategory: "] == $catalog->name) {


                                        DB::insert("insert ignore into propetites(cat_slug,brand) values (?,?)",[$catalog->slug,$item['brand:']]);

                                    }

                                }
                            }

                        }
                    } else {
                        $catalogs = Categories::where('parent_id', '=', 0)->get();
                        foreach ($catalogs as $catalog) {
                            if ($item["firstSubcategory: "] == $catalog->name) {
                                $splitModel = function ($string) {
                                    return explode('MIX', $string)[0];
                                };

                                DB::insert("insert ignore into propetites(cat_slug,brand) values (?,?)",[$catalog->slug,$item['brand:']]);

                            }

                        }
                    }
                }

            }
        }
    }

}
