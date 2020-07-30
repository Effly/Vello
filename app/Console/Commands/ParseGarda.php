<?php

namespace App\Console\Commands;


use http\Exception;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class ParseGarda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:garda';
    protected $url = 'https://bft.msk.ru/shlagbaumi-i-bareri/avtomaticheskie-bareri/';


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
        $crawler = new Crawler(file_get_contents($this->url));
        $products = $this->getProducts($crawler);
        dd($products);
    }

    public function getProducts($crawler)
    {

        return $crawler->filter('.product-list .imagejail')->each(function (Crawler $node) {
            dump($node->attr('src'));


//                $checkOrEmpty = function ($node) {
//                    return $node->count() ? $node->text() : '';
//                };
//
//                return [
//                    'link' => $node->filter('.imagejail'),
//                    'desc' => $checkOrEmpty($node->filter('ul')),
//                    'price' => trim($checkOrEmpty($node->filter('.price')->eq(0)))
//
//                ];
//            });
//        $items[] = $getItems;
//        return $items;

//        return [
//            'price' => $crawler->filter('.price strong')->each(function (Crawler $node){
//               return trim($node->text());
//
//            }),
//        ];


//        $fetchProducts = function($crawler){
//            return $crawler->filter('.right .price')->each(function (Crawler $node){
//                dd($node);
//                return [
//                    'price' => $node->filter('.price strong')->text(),
//                ];
//            });
//        };

        });
    }
}

