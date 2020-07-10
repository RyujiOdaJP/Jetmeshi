<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    // グローバル変数
    // 管理者のID番号を1とする
    // 参照: https://stackoverflow.com/questions/28356193/
    config(['admin_id' => 1]);
    $URL = new URL;
    if (request()->isSecure()) {
        $URL->forceScheme('https');
    }
  }
}
