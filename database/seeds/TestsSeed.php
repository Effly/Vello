<?php

use App\Categories;
use App\Models\Catalog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestsSeed extends Seeder
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
                                        $splitModel = function ($string) {
                                            return explode('MIX', $string)[0];
                                        };

                                        DB::table('products')->insert([
                                            'cat_slug' => $catalog->slug,
                                            'title' => $item["title:"],
                                            'code' => $item["code:"],
                                            'brand' => $item["brand:"],
                                            'cost' => $item["cost:"],
                                            'model' => $splitModel($item["model:"]),
                                            'desc' => $item["desc:"],
                                            'slug' => Str::slug($item["title:"], '-')
                                        ]);

                                    }

                                }
                            }

                        } else {
                            for ($i = 1; $i <= 4; $i++) {
                                $catalogs = Categories::where('parent_id', '=', $i)->get();
                                foreach ($catalogs as $catalog) {
                                    if ($item["secondSubcategory: "] == $catalog->name) {
                                        $splitModel = function ($string) {
                                            return explode('MIX', $string)[0];
                                        };

                                        DB::table('products')->insert([
                                            'cat_slug' => $catalog->slug,
                                            'title' => $item["title:"],
                                            'code' => $item["code:"],
                                            'brand' => $item["brand:"],
                                            'cost' => $item["cost:"],
                                            'model' => $splitModel($item["model:"]),
                                            'desc' => $item["desc:"],
                                            'slug' => Str::slug($item["title:"], '-')
                                        ]);

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

                                DB::table('products')->insert([
                                    'cat_slug' => $catalog->slug,
                                    'title' => $item["title:"],
                                    'code' => $item["code:"],
                                    'brand' => $item["brand:"],
                                    'cost' => $item["cost:"],
                                    'model' => $splitModel($item["model:"]),
                                    'desc' => $item["desc:"],
                                    'slug' => Str::slug($item["title:"], '-')
                                ]);

                            }

                        }
                    }
                }

            }
        }
    }

}
//при наша если для
