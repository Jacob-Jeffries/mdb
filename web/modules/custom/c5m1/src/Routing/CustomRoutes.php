<?php

namespace Drupal\c5m1\Routing;

use Symfony\Component\Routing\Route;

class CustomRoutes {
  public function routes() {
    $routes = [];
    // Create mypage route programmatically
    $routes['c5m1.mypage'] = new Route(
      // Path definition
      'mypage',
      // Route defaults
      [
        '_controller' =>
        '\Drupal\c5m1\Controller\MyPageController::customPage',
        '_title' => 'My custom page',
      ],
      // Route requirements
      [
        '_permission' => 'access content',
      ]
    );
    return $routes;
  }
}