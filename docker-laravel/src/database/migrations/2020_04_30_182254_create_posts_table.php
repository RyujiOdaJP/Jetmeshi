<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** 新しいデータベーステーブルを作成するには、Schemaファサードのcreateメソッドを使用します。
         * createメソッドは引数を２つ取ります。最初はテーブルの名前で、２つ目は新しいテーブルを
         * 定義するために使用するBlueprintオブジェクトを受け取る「クロージャ」です。
         *
         * カラムの追加や編集をする場合は、上記で作成したマイグレーションファイルを編集し、
         * refreshを付けて再度マイグレーションを実行します。
         * $ php artisan migrate:refresh
         * migrate:refreshは、migrate:resetしてmigrateする
         */
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
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

            //外部キー用のuser_idカラムをpostsテーブルに追加します。
            // $table->integer('user_id')->unsigned()->default(1);
            // $table->foreign('user_id')
            //       ->references('id')->on('users')
            // foreignIdメソッドはunsignedBigIntegerのエイリアスです。
            // 一方のconstrainedメソッドはテーブルとカラム名をforeignIdで指定したカラム名をもとに規約により決定します。
            // テーブル名が規約と合っていない場合は、constrainedメソッドの引数にテーブル名を渡してください。
            $table->foreignId('user_id')->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('tag_id')->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
     * --stepを付加すると逆上るマイグレーションファイル数を指定できます。例えば下記では最新から1つ目までのマイグレーションファイルのdown()のみが実行されます。
     * $ php artisan migrate:rollback --step=1
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
