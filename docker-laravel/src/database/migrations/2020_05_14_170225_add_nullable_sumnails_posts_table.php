<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableSumnailsPostsTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('posts', function (Blueprint $table): void {
      //add nullable to optional photos
      $table->string('sumnail_pc')->nullable()->change();
      $table->string('sumnail_mobile')->nullable()->change();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
  }
}
