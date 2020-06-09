<?php

declare(strict_types=1);

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Post;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Post::class => PostPolicy::class,
    ];

  /**
   * Register any authentication / authorization services.
   */
  public function boot(): void
  {
    $this->registerPolicies();
  }
}
