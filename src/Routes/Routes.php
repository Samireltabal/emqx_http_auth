<?php 

  use SamirEltabal\EmqxAuth\Controllers\EmqxController;

  Route::get('/', function() {
    return EMQX::ping();
  });

  Route::post('/auth', [EmqxController::class, 'authenticate']);
  Route::post('/super', [EmqxController::class, 'super_user']);
  Route::post('/acl', [EmqxController::class, 'acl']);