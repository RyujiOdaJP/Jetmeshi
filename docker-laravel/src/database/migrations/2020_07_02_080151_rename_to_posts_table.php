<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameToPostsTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('posts', function (Blueprint $table): void {
      $table->renameColumn('sumnail_pc', 'thumbnail_pc');
      $table->renameColumn('sumnail_mobile', 'thumbnail_mobile');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('posts', function (Blueprint $table): void {
      $table->renameColumn('thumbnail_pc', 'sumnail_pc');
      $table->renameColumn('thumbnail_mobile', 'sumnail_mobile');
    });
  }
}
