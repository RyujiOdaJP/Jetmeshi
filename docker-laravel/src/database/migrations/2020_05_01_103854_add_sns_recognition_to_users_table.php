<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSnsRecognitionToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //add column
            $table->boolean('LINE');
            $table->boolean('Twitter');
            $table->boolean('Google');
        });
    }
    // SNS認証を選んだユーザーにはパスワード設定を通常は求めません（OAuth認証後にパスワードを要求するのは避けてください）。
    // さらに選択したOAuthプロバイダーには登録メールアドレスがないかもしれません。したがって、
    // usersテーブルのemailとpasswordフィールドをnullableにします。

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //drop column
            $table->dropColumn('');
        });
    }
}
