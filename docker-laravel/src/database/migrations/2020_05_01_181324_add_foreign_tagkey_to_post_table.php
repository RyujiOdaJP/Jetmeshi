<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignTagkeyToPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('posts', function (Blueprint $table) {
            //外部キー用のuser_idカラムをpostsテーブルに追加します。
            // $table->integer('user_id')->unsigned()->default(1);
            // $table->foreign('user_id')
            //       ->references('id')->on('users')
            // foreignIdメソッドはunsignedBigIntegerのエイリアスです。
            // 一方のconstrainedメソッドはテーブルとカラム名をforeignIdで指定した
            // カラム名をもとに規約により決定します。
            // テーブル名が規約と合っていない場合は、constrainedメソッドの引数にテーブル名を渡してください。
            $table->foreignId('tag_id')->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('tags_post_id_foreign');
            $table->dropColumn('tag_id');
        });
    }
}
