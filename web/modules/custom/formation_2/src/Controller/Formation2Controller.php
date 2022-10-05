<?php

namespace Drupal\formation_2\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Formation 2 routes.
 */
class Formation2Controller extends ControllerBase {

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
