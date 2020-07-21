<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class parse extends Command
{
    protected $signature = 'parse:mix';

    protected $url = 'https://www.mixtcar.ru';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $crawler = new Crawler(file_get_contents($this->url));
        $categoryData = $this->getCategories($crawler);

//        $products = $this->getItems(array_slice($categoryData['thirdCategories'],119,16));
//        $getJSON = $this->getCrankMechanism($products );
//        $products = $this->getItems(array_slice($categoryData['thirdCategories'],134,14));
//        $getJSON = $this->getGasDistributionMechanism($products );
        dd($categoryData);


    }

    public function getCategories($crawler)
    {

        // $prepareStr = fn($node) => str_replace("\n", '', $node->text());
        $prepareStr = function ($node) {
            return str_replace("\n", '', $node->text());
            //return $node->text();
        };
        $categories = [];
        $subCategories = [];
        $thirdCategories = [];

        $crawler->filter('.block__list.list--first .block__list--item.item--drop--first')->each(function (Crawler $node, $i) use (&$categories, &$subCategories, &$thirdCategories, $prepareStr) {
            if ($i > 4) {
                return $node;
            }
            $link = $node->filter('a.link--drop--first');

            $categories[$prepareStr($link)] = $link->attr('href');
            $subCatList = $node->filter('.block__list.list--second .block__list--item.item--drop--second');
            if ($subCatList->count()){
                $subCatList->each(function (Crawler $node, $i) use (&$subCategories, &$thirdCategories, $prepareStr) {
                    $link = $node->filter('.link--drop--second');
                    //dd($link->text());
                    $subCategories[$prepareStr($link)] = $link->attr('href');
                    $thirdCatList = $node->filter('.block__list.list--third');
                    if ($thirdCatList->count()) {
                        $thirdCatList->filter('li.block__list--item')->each(function (Crawler $node, $i) use (&$thirdCategories, $prepareStr) {
                            $link = $node->filter('a.item__link');
                            $thirdCategories[$prepareStr($link)] = $link->attr('href');
                        });

                    } else {

                        $thirdCategories[$prepareStr($link)] = $link->attr('href');

                    }
                });

            }else{

                $thirdCategories[$prepareStr($link)] = $link->attr('href');
            }
            return $node;
        });

        return [
            'categories' => $categories,
            'subCategories' => $subCategories,
            'thirdCategories' => $thirdCategories
        ];
    }

    public function getItems($categories)
    {
        $items =[];
        $paginateLastPage = function ($crawler) {
            return $crawler->filter('.sort-b__paging-list')->first()->filter('.sort-b__paging-item')->last();
        };

        $fetchProducts = function ($crawler) use ($categories) {
            return $crawler->filter('.product_inner_wrap')->each(function (Crawler $node) use ($crawler, $categories) {
                return $getCardLink = $node->filter('a.pruduct_grid_title')->each(function (Crawler $node) {
                    $cardLinks = $node->attr('href');
                    $prepareStr = function ($node) {
                        return str_replace("\n", '', $node);
                    };
                    $splitExcess = function($node){
                        return $node = explode('<br> \n <br>',$node)[0];
                    };

                    $checkOrEmpty = function($node){
                        return $node->count() ? $node->text() : '';
                    };
                    $crawler = new Crawler(file_get_contents($this->url . $cardLinks));
                    return [

                        'firstSubcategory: ' =>$crawler->filter('.breadcrumb a')->eq(2)->text(),
                        'secondSubcategory: ' =>$checkOrEmpty($crawler->filter('.breadcrumb a')->eq(3)),
                        'thirdSubcategory: ' =>$checkOrEmpty($crawler->filter('.breadcrumb a')->eq(4)),

                        'title:' =>$prepareStr($crawler->filter('.good h1')->text()),
                        'code:' => $prepareStr($crawler->filter('.good span span')->text()),
                        'brand:' => $prepareStr($crawler->filter('.good  span span')->last()->text()),
                        'cost:' => trim(explode('₽',$prepareStr($crawler->filter('.good .cupit')->first()->text()))[0]),//раздел сначала по P а потом от \t
                        'model:' => $prepareStr($crawler->filter('.table table tr')->last()->filter('td')->last()->text()),
                        'desc:' => $prepareStr(trim($splitExcess($crawler->filter('.tabs div p')->text()))),

                    ];

                });
            });
        };


        foreach ($categories as $category => $link) {
            $crawler = new Crawler(file_get_contents($this->url . $link));
            $lastPage = $paginateLastPage($crawler);
            $lastPageLink = $lastPage->filter('a.sort-b__paging-links');
            $items[] = $fetchProducts($crawler);
            if (!$lastPageLink->count()) continue;
            $lastPageNum = (int)$lastPageLink->text();
            $lastPageLink = $lastPageLink->attr('href');
            $pageLink = explode('PAGEN_1=', $lastPageLink)[0] . 'PAGEN_1=';
            for ($i = 2; $i <= $lastPageNum; $i++) {
                $crawler = new Crawler(file_get_contents($this->url . $pageLink . $i));

                $items[] = $fetchProducts($crawler);
                $this->info($i);

            }
        }


        return $items;
    }
    public function getCrankMechanism($products){

        //Кривошипно-шатунный механизм двигателя
        $getFile = fopen('getCrankMechanism.json', 'a+');
        $writeFile = fwrite($getFile,json_encode($products,  JSON_UNESCAPED_UNICODE));
        $closeFile = fclose($getFile);
        return $getFile;
    }
    public function getGasDistributionMechanism($products){

        //Газораспределительный механизм двигателя
        $getFile = fopen('getGasDistributionMechanism&Seals.json', 'a+');
        $writeFile = fwrite($getFile,json_encode($products,  JSON_UNESCAPED_UNICODE));
        $closeFile = fclose($getFile);
        return $getFile;
    }
}
