<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

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
//require_once ABSPATH . 'wp-admin/includes/image.php';
//require_once ABSPATH . 'wp-admin/includes/file.php';
//require_once ABSPATH . 'wp-admin/includes/media.php';
//// //Для работы функции проверки наличия поста по названию
//require_once ABSPATH . 'wp-admin/includes/post.php';
//$category_ID = array(107, 112);
//
//$main = json_decode(file_get_contents(dirname(__FILE__) . '/Shlangbaum.json'), true);
//
//$posts_count = 0;
//
//foreach ($main as $singles) {//Перебор полученных массивов с данными
//    foreach ($singles as $items) {
////        //Проверка наличия поста по его названию
//
////        // echo $single["thumb"];
//            if (!post_exists($items["title:"])) {
//                //Массив атрибутов для создания поста
//                $post_data = array(
//                    'post_title' => $items["title:"],
//                    'post_content' => '',
//                    'post_status' => 'publish',
//                    'post_author' => 1,
//                    'post_category' => $category_ID, //ID категории
//
//                );
//                //Добавление поста
//                $last_post_id = wp_insert_post($post_data); //возвратит ID созданного поста
//                //Добавление картинки к посту
//                $img_tag = media_sideload_image($items["link"], $last_post_id, $desc = null, 'id'); // Ссылка на файл : ID поста к которому прикрепляем : возвращаем id
//                update_field('product_image', $img_tag, $last_post_id);// добавление картинки: имя поля : id картинки :id поста
//                //Прикрепление загруженой картинки к миниатюре поста
//                set_post_thumbnail($last_post_id, $img_tag);
//                update_post_meta($last_post_id, 'product_price', $items["cost:"]); // ID поста : название доп. поля : контент для добавления
//                update_post_meta($last_post_id, 'product_description', $items["desc:"]); // ID поста : название доп. поля : контент для добавления
//
//                echo 'Пост [' . $last_post_id . '] - ' . $items["title:"] . ' создан!<br>';
//                $posts_count++;
//            } else {
//                echo 'Пост с названием ' . $item["title:"] . ' уже существует!<br>';
//            }
//    }
//}

    public function todo()
    {

        foreach ($countObls as $countObl => $value) {
            foreach ($mains as $main) {
                if ($main["область"] == $countObl) {
                    $catID = wp_create_category($countObl, 106);
                    if (!post_exists($main["Населенный пункт"])) {
                        //Массив атрибутов для создания поста
                        $post_data = array(
                            'post_title' => $main["Населенный пункт"],
                            'post_content' => '',
                            'post_status' => 'publish',
                            'post_author' => 1,
                            'post_category' => array(106, $catID) //ID категории
                        );
                        //Добавление постаm
                        $last_post_id = wp_insert_post($post_data);
                        echo 'Пост [' . $last_post_id . '] - ' . $main["Населенный пункт"] . ' создан!<br>';
                        foreach ($countPunkts as $countPunkt => $val) {
                            if ($countPunkt == $main["Населенный пункт"]) {
                                if (have_rows()) {
                                    while (have_rows('offices')) {
                                        the_row();
                                        $i = 1;
                                        $row = array(
                                            'type' => $main["Тип"],
                                            'address' => $main["Адрес"],
                                            'mainPhone' => $main["Телефон"],
                                            'email' => $main["E-mail для заявок(основной)"],
                                            'othPhones' => $main["Телефоны дополнительные"],
                                            'othEmail' => $main["E-mail дополнительные"],
                                            'workTime' => $main["Время работы"]
                                        );
                                        update_row('offices', $i, $row, $last_post_id);
                                        $i++;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

}



