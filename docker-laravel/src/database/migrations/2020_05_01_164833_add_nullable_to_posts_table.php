<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToPostsTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('posts', function (Blueprint $table): void {
      //add nullable to optional photos
      $table->string('image_2')->nullable()->change();
      $table->string('image_3')->nullable()->change();
      $table->string('image_4')->nullable()->change();
      $table->string('image_5')->nullable()->change();
      // $table->dropColumn('tag_id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    // Schema::dropIfExists('tag_maps');
    Schema::table('posts', function (Blueprint $table): void {
      //remove nullable from optional photos
            // $table->string('image_2')->nullable(false)->change();
            // $table->string('image_3')->nullable(false)->change();
            // $table->string('image_4')->nullable(false)->change();
            // $table->string('image_5')->nullable(false)->change();
            // $table->dropColumn('tag_id');
    });
    // Schema::table('tags', function (Blueprint $table) {
        //     外部キー用のuser_idカラムをpostsテーブルに追加します。
        //     $table->integer('user_id')->unsigned()->default(1);
        //     $table->foreign('user_id')
        //           ->references('id')->on('users')
        //     foreignIdメソッドはunsignedBigIntegerのエイリアスです。
        //     一方のconstrainedメソッドはテーブルとカラム名をforeignIdで指定した
        //     カラム名をもとに規約により決定します。
        //     テーブル名が規約と合っていない場合は、constrainedメソッドの引数にテーブル名を渡してください。

        //     $table->dropForeign('tags_user_id_foreign');
        //     $table->dropColumn('user_id');
        //  $table->dropColumn('post_id');
            // $table->renameColumn('tag_id', 'id');
        // });
  }
}
