<?php

namespace Drupal\c5m1\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloWorldController extends ControllerBase {

  /**
   * Returns markup for our custom page.
   *
   * @returns array
   *   The render array.
   */
  public function page(): array {
    return [
      '#markup' => '<p>Hello world!</p><p>This is Jacob</p>'
    ];
  }

}