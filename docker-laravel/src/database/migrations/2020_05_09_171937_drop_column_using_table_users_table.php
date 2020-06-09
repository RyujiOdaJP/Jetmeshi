<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnUsingTableUsersTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('users', function (Blueprint $table): void {
      //add column using_status
      $table->dropColumn('using_status');
    });
    Schema::table('posts', function (Blueprint $table): void {
      //add column using_status
      $table->dropColumn('using_status');
    });
    Schema::table('tags', function (Blueprint $table): void {
      //add column using_status
      $table->dropColumn('using_status');
    });
    Schema::table('tag_maps', function (Blueprint $table): void {
      //add column using_status
      $table->dropColumn('using_status');
    });
    Schema::table('likes', function (Blueprint $table): void {
      //add column using_status
      $table->dropColumn('using_status');
    });
    Schema::table('reviews', function (Blueprint $table): void {
      //add column using_status
      $table->dropColumn('using_status');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table): void {
      //add column using_status
      $table->boolean('using_status');
    });
    Schema::table('posts', function (Blueprint $table): void {
      //add column using_status
      $table->boolean('using_status');
    });
    Schema::table('tags', function (Blueprint $table): void {
      //add column using_status
      $table->boolean('using_status');
    });
    Schema::table('tag_maps', function (Blueprint $table): void {
      //add column using_status
      $table->boolean('using_status');
    });
    Schema::table('likes', function (Blueprint $table): void {
      //add column using_status
      $table->boolean('using_status');
    });
    Schema::table('reviews', function (Blueprint $table): void {
      //add column using_status
      $table->boolean('using_status');
    });
  }
}
