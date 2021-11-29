<?php 
  namespace SamirEltabal\EmqxAuth;

  use Illuminate\Support\Facades\Route;
  use Illuminate\Support\ServiceProvider;


  class EmqxAuthServiceProvider extends ServiceProvider {

    public function boot() {
      $this->registerRoutes();
    }

    public function register () {
      $this->mergeConfigFrom(__DIR__.'/Config/EMQX.php', 'EMQX');
    }


    protected function registerRoutes () {
      Route::group($this->routeConfiguration(), function () {
        $this->loadRoutesFrom(__DIR__.'/./Routes/Routes.php');
      });
    }

    protected function routeConfiguration () {
      return [
        'prefix' => config('EMQX.prefix'),
        'middleware' => config('EMQX.middleware'),
       ];
    }

  }