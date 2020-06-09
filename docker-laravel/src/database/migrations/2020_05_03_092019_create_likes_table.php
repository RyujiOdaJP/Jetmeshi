<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('likes', function (Blueprint $table): void {
      $table->id();
      $table->foreignId('user_id')->constrained()
        ->onDelete('cascade')->onUpdate('cascade')->change();
      $table->foreignId('post_id')->constrained()
        ->onDelete('cascade')->onUpdate('cascade')->change();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('likes');
  }
}
