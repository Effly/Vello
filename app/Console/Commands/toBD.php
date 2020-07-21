<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class toBD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'to:bd';


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

        $products = $this->todo();

    }


    public function todo()
    {
        $titles = [];
        $categories = json_decode(file_get_contents('D:\op\OSPanel\domains\parse\resultsFolder\Categories.json'), true);
        //dd($categories[0][0][0]['firstSubcategory: ']);
        foreach ($categories as $category) {

            foreach ($category as $item => $link) {

                $posFirstCat = stristr($link,"/product_list/zapchasti-pogruzchikov/");
                if ($posFirstCat){
                    echo 1;
                }
            }
        }


    }
}
