<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    /* 新しいデータベーステーブルを作成するには、Schemaファサードのcreateメソッドを使用します。
     * createメソッドは引数を２つ取ります。最初はテーブルの名前で、２つ目は新しいテーブルを
     * 定義するために使用するBlueprintオブジェクトを受け取る「クロージャ」です。
     *
     * カラムの追加や編集をする場合は、上記で作成したマイグレーションファイルを編集し、
     * refreshを付けて再度マイグレーションを実行します。
     * $ php artisan migrate:refresh
     * migrate:refreshは、migrate:resetしてmigrateする
     */
    Schema::create('posts', function (Blueprint $table): void {
      $table->id();
      $table->timestamps();
      $table->string('title');
      $table->string('image_top');
      $table->string('image_2');
      $table->string('image_3');
      $table->string('image_4');
      $table->string('image_5');
      $table->text('sequence');
      $table->unsignedInteger('cooking_time');
      $table->unsignedInteger('budget');
    });

    // To modify or drop table, no need to create new migration file, instead do like below.
        // Schema::table('contacts', function (Blueprint $table) {
        // $table->dropColumn('is_promoted');
        //});
  }

  /**
   * Reverse the migrations.
   * resetでは、存在するすべてのマイグレーションファイルのdown()が実行されます。
   * rollbackでは、直近にまとめて実行したマイグレーションファイルのdown()がすべて実行されます。
   * --stepを付加すると逆上るマイグレーションファイル数を指定できます。
   * 例えば下記では最新から1つ目までのマイグレーションファイルのdown()のみが実行されます。
   * $ php artisan migrate:rollback --step=1.
   */
  public function down(): void
  {
    Schema::dropIfExists('posts');
  }
}
