<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->float('discount')->nullable();
            $table->float('price');
            $table->string('name');
            $table->string('manufacturer')->nullable();
            $table->string('size')->nullable();
            $table->string('image')->nullable();
            $table->string('description');
            $table->unsignedInteger('categoryID');
            $table->foreign('categoryID')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedInteger('subcategoryID');
            $table->foreign('subcategoryID')->references('id')->on('subcategories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
