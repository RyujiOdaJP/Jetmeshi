<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPostsTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('posts', function (Blueprint $table): void {
      $table->foreignId('user_id')->after('id')
        ->constrained()->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('posts', function (Blueprint $table): void {
      $table->dropForeign('posts_user_id_foreign');
      $table->dropColumn('user_id');
    });
  }
}
