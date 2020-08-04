<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailResetsTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('email_resets', function (Blueprint $table): void {
      $table->bigIncrements('id');
      $table->integer('user_id')->comment('メールアドレスを更新したユーザーID');
      $table->string('new_email')->comment('ユーザーが新規に設定したメールアドレス');
      $table->string('token');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('email_resets');
  }
}
