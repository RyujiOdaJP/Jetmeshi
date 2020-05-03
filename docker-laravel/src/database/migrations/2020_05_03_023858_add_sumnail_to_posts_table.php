<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSumnailToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //Add sumnail columns
            $table->string('sumnail_pc')->after('image_top');
            $table->string('sumnail_mobile')->after('sumnail_pc');
            $table->renameColumn('image_2','image_seq1');
            $table->renameColumn('image_3','image_seq2');
            $table->renameColumn('image_4','image_seq3');
            $table->renameColumn('image_5','image_seq4');
            $table->renameColumn('sequence','sequence_body');
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
            //
            $table->dropColumn('sumnail_pc');
            $table->dropColumn('sumnail_mobile');
            $table->renameColumn('image_seq1','image_2');
            $table->renameColumn('image_seq2','image_3');
            $table->renameColumn('image_seq3','image_4');
            $table->renameColumn('image_seq4','image_5');
            $table->renameColumn('sequence_body','sequence');
        });
    }
}
