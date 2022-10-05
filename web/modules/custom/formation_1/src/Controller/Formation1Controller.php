<?php

namespace Drupal\formation_1\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Formation 1 routes.
 */
class Formation1Controller extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
