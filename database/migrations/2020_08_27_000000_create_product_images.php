<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('image');
            $table->foreign('product_id')->references('id')->on('products');
			$table->timestamps();
		});
		
		Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['image1','image2','image3','image4','image5','image6','image7','image8','image9','image10']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('product_images');
		Schema::table('products', function (Blueprint $table) {
			$table->string('image1');
			$table->string('image2');
			$table->string('image3');
			$table->string('image4');
			$table->string('image5');
			$table->string('image6');
			$table->string('image7');
			$table->string('image8');
			$table->string('image9');
			$table->string('image10');
        });
    }
}
