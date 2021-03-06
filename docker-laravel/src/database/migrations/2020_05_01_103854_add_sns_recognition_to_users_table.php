<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSnsRecognitionToUsersTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('users', function (Blueprint $table): void {
      //add column
      $table->string('provider_id')->nullable();
      $table->string('provider_name')->nullable();
      // $table->boolean('LINE');
      // $table->boolean('Twitter');
      // $table->boolean('Google');

      //add index
      // $table->unique(['provider_id', 'provider_name']);

      // Making email and password nullable
      $table->string('email')->nullable()->change();
      $table->string('password')->nullable()->change();
    });
  }

  // SNS認証を選んだユーザーにはパスワード設定を通常は求めません（OAuth認証後にパスワードを要求するのは避けてください）。
  // さらに選択したOAuthプロバイダーには登録メールアドレスがないかもしれません。したがって、
  // usersテーブルのemailとpasswordフィールドをnullableにします。

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table): void {
      //drop column
            // $table->dropColumn('provider_id');
            // $table->dropColumn('provider_name');
            // $table->dropColumn('LINE');
            // $table->dropColumn('Twitter');
            // $table->dropColumn('Google');
            // $table->dropUnique(['provider_id', 'provider_name']);

            // $table->string('email')->nullable(false)->change();
            // $table->string('password')->nullable(false)->change();
    });
  }
}
