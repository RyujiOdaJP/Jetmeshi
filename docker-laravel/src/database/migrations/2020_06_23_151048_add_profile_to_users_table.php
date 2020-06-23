<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileToUsersTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('users', function (Blueprint $table): void {
      $table->string('image')->nullable()->after('password');
      $table->text('bio')->nullable()->after('image');
      $table->string('twitter')->nullable()->after('bio');
      $table->string('instagram')->nullable()->after('bio');
      $table->string('github')->nullable()->after('bio');
      $table->string('facebook')->nullable()->after('bio');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table): void {
      $table->dropColumn('image');
      $table->dropColumn('bio');
      $table->dropColumn('twitter');
      $table->dropColumn('instagram');
      $table->dropColumn('github');
      $table->dropColumn('facebook');
    });
  }
}
