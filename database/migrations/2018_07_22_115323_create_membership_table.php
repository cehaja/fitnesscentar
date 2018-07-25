<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->increments('id');
            $table->date('startDate');
            $table->date('endDate');
            $table->unsignedInteger('userID');
            $table->unsignedInteger('typeID');
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('typeID')->references('id')->on('membership_types')->onDelete('cascade');
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
        Schema::dropIfExists('memberships');
    }
}
