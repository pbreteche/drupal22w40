<?php

namespace Drupal\formation_3\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Formation 3 routes.
 */
class Formation3Controller extends ControllerBase {

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
