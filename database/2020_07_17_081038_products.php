<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table){
            $table->increments('id');
            $table->integer('third_cat_id')->unsigned()->default(0);
            $table->foreign('third_cat_id')
                ->references('id')->on('third_category')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('code');
            $table->string('brand');
            $table->string('cost');
            $table->string('model');
            $table->text('desc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
