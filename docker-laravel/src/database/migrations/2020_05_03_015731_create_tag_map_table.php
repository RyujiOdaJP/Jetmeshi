<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('tags', function (Blueprint $table) {
        //     $table->renameColumn('tag_id','id');
        // });

        Schema::create('tag_map', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()
            ->onDelete('cascade')->onUpdate('cascade')->change();
            $table->foreignId('tag_id')->constrained()
            ->onDelete('cascade')->onUpdate('cascade')->change();;
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
        Schema::dropIfExists('tag_map');
        // Schema::table('posts', function (Blueprint $table) {
        //     $table->renameColumn('id','post_id');
        // });
    }
}
