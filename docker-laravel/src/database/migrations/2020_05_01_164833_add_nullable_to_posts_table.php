<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //add nullable to optional photos
            $table->string('image_2')->nullable()->change();
            $table->string('image_3')->nullable()->change();
            $table->string('image_4')->nullable()->change();
            $table->string('image_5')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //remove nullable from optional photos
            $table->string('image_2')->nullable(false)->change();
            $table->string('image_3')->nullable(false)->change();
            $table->string('image_4')->nullable(false)->change();
            $table->string('image_5')->nullable(false)->change();
        });
    }
}
