<?php

namespace Drupal\c5m1\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class RouteSubscriber extends RouteSubscriberBase {
  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {
    // Change path of c5m1.hello_world to just 'hello'
    if ($route = $collection->get('c5m1.hello_world')) {
      $route->setPath('/hello');
    }
  }
}