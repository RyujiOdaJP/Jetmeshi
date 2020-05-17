<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // グローバル変数
        // 管理者のID番号を1とする
        // 参照: https://stackoverflow.com/questions/28356193/
        config(['admin_id' => 1]);
    }
}
