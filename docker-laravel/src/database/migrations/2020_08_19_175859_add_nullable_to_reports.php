<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToReports extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('reports', function (Blueprint $table): void {
      $table->Integer('harmful')->nullable()->change();
      $table->Integer('irrevant')->nullable()->change();
      $table->Integer('personal')->nullable()->change();
      $table->Integer('inappropriate')->nullable()->change();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('reports', function (Blueprint $table): void {
    });
  }
}
