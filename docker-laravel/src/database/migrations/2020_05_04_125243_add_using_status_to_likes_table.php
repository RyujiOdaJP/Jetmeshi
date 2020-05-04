<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsingStatusToLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //add column using_status
            $table->boolean('using_status');
        });
        Schema::table('posts', function (Blueprint $table) {
            //add column using_status
            $table->boolean('using_status');
        });
        Schema::table('tags', function (Blueprint $table) {
            //add column using_status
            $table->boolean('using_status');
        });
        Schema::table('tag_map', function (Blueprint $table) {
            //add column using_status
            $table->boolean('using_status');
        });
        Schema::table('likes', function (Blueprint $table) {
            //add column using_status
            $table->boolean('using_status');
        });
        Schema::table('reviews', function (Blueprint $table) {
            //add column using_status
            $table->boolean('using_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //drop column
            $table->dropColumn('using_status');
        });
        Schema::table('posts', function (Blueprint $table) {
            //drop column
            $table->dropColumn('using_status');
        });
        Schema::table('tags', function (Blueprint $table) {
            //drop column
            $table->dropColumn('using_status');
        });
        Schema::table('tag_map', function (Blueprint $table) {
            //drop column
            $table->dropColumn('using_status');
        });
        Schema::table('likes', function (Blueprint $table) {
            //drop column
            $table->dropColumn('using_status');
        });
        Schema::table('reviews', function (Blueprint $table) {
            //drop column
            $table->dropColumn('using_status');
        });
    }
}
