<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagMapTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    // Schema::table('tags', function (Blueprint $table) {
    //     $table->renameColumn('tag_id','id');
    // });

    Schema::create('tag_maps', function (Blueprint $table): void {
      $table->id();
      $table->foreignId('post_id')->constrained()
        ->onDelete('cascade')->onUpdate('cascade')->change();
      $table->foreignId('tag_id')->constrained()
        ->onDelete('cascade')->onUpdate('cascade')->change();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tag_maps');
    // Schema::table('posts', function (Blueprint $table) {
        //     $table->renameColumn('id','post_id');
        // });
  }
}
