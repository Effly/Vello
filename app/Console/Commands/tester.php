<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class tester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tester:site';
    protected $url = 'https://www.mixtcar.ru';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $crawler = new Crawler(file_get_contents($this->url));//Весь контент
        $categories = $this->getCategories($crawler);

       //$products = $this->getItems(array_slice($categories,0,1));
        dd($categories);

    }


    public function getCategories($crawler)
    {
        $categories = [];
        $secCategories = [];
        $thirdCategories = [];
        $crawler->filter('.block__list.list--first .block__list--item.item--drop--first')->each(function ($node, $i) use (&$categories, &$secCategories, &$thirdCategories) {
            $prepareStr = function ($node) {
                return str_replace("\n", '', $node->text());
                //return $node->text();
            };
            if ($i > 4) {
                return $node;
            }
            $link = $node->filter('a.item__link.link--drop--first');
            //$temp['link'] = $link->attr('href');

            $secCategories = $this->getSecondCategories($node);
            $temp[$prepareStr($link)] = $secCategories;
            $categories[$prepareStr($link)]= $temp;

            return $node;

        });
        //dd($categories);
        return $categories;
    }

    public function getSecondCategories($node)
    {
        $secCategories = [];
        $thirdCategories = [];
        $items = [];
        $node->filter('.block__list.list--second .block__list--item.item--drop--second')->each(function ($node) use (&$secCategories, &$thirdCategories) {
            $prepareStr = function ($node) {
                return str_replace("\n", '', $node->text());
                //return $node->text();
            };
            $link = $node->filter('a.item__link.link--drop--second');
            //$temp[$prepareStr($link)] = $link->attr('href');
            if ($node->filter('.block__list.list--third .block__list--item')->count()) {
                $thirdCategories = $this->getThirdCategories($node);

            } else {
                $thirdCategories[$prepareStr($link)] = $link->attr('href');
            }
            $temp[$prepareStr($link)] = $thirdCategories;
            $secCategories[]= $temp;

        });


        return $secCategories;

    }

    public function getThirdCategories($node)
    {
        $thirdCategories = [];


        $node->filter('.block__list.list--third .block__list--item')->each(function ($node) use (&$thirdCategories) {
            $link = $node->filter('a.item__link');

            $prepareStr = function ($node) {
                return str_replace("\n", '', $node->text());
                //return $node->text();
            };
            $thirdCategories[$prepareStr($link)] = $link->attr('href');


        });

        //dd($thirdCategories);
        return $thirdCategories;
    }
//$categories[
//    $secCatigories[
//        $thirdCategories[
//            ],]

    public function getItems($categories)
    {
        $items = [];
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
                    $crawler = new Crawler(file_get_contents($this->url . $cardLinks));
                    return [
                        'title:  ' =>$prepareStr($crawler->filter('.good h1')->text()),
                        'code: ' => $prepareStr($crawler->filter('.good span span')->text()),
                        'brand' => $prepareStr($crawler->filter('.good  span span')->last()->text()),
                        'cost' => trim(explode('₽',$prepareStr($crawler->filter('.good .cupit')->first()->text()))[0]),//раздел сначала по P а потом от \t
                        'model' => $prepareStr($crawler->filter('.table table tr')->last()->filter('td')->last()->text()),
                        'desc' => $prepareStr(trim($splitExcess($crawler->filter('.tabs div p')->text()))),

                    ];

                });
            });
        };


        foreach ($categories as $category => $item) {
            foreach ($category[$item] as $secCategories => $secCategory){
                foreach ($secCategories[$secCategory] as $thirdCategories => $link )

            $crawler = new Crawler(file_get_contents($this->url . $link));
            $lastPage = $paginateLastPage($crawler);
            $lastPageLink = $lastPage->filter('a.sort-b__paging-links');
            $nodes[] = $fetchProducts($crawler);
            if (!$lastPageLink->count()) continue;
            $lastPageNum = (int)$lastPageLink->text();
            $lastPageLink = $lastPageLink->attr('href');
            $pageLink = explode('PAGEN_1=', $lastPageLink)[0] . 'PAGEN_1=';
            for ($i = 2; $i <= $lastPageNum; $i++) {
                $crawler = new Crawler(file_get_contents($this->url . $pageLink . $i));

                $nodes[] = $fetchProducts($crawler);
                $this->info($i);

                }
            }
        }
//        $output = [];
//        foreach ($nodes as $item) {
//            array_push($output, ...$item);
//        }

        return $nodes;
    }


//    public function fetchCategories($node,$link,$list,$item){
//
//        $categories=[];
//
//        $node->filter($list.' ')
//    }

}
