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
        *createメソッドは引数を２つ取ります。最初はテーブルの名前で、２つ目は新しいテーブルを
        *定義するために使用するBlueprintオブジェクトを受け取る「クロージャ」です
        */
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('posts');
    }
}
