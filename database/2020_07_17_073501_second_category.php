<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SecondCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_category', function(Blueprint $table){
            $table->increments('id');
            $table->integer('first_cat_id')->unsigned()->default(0);
            $table->foreign('first_cat_id')
                ->references('id')->on('first_category')
                ->onDelete('cascade');
            $table->string('name_scnd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('second_category');
    }
}
