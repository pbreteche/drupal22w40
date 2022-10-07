<?php

namespace Drupal\message\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Message routes.
 */
class MessageController extends ControllerBase {


  /**
   * Builds the response.
   */
  public function build() {
    $messageStorage = $this->entityTypeManager()->getStorage('message');

    $messageIds = $messageStorage
      ->getQuery()
      ->accessCheck()
      ->condition('uid', \Drupal::currentUser()->id())
      ->execute()
    ;

    $messages = $messageStorage->loadMultiple($messageIds);

    $build['content'] = [
      '#theme' => 'message-box',
      '#messages' => $messages,
    ];

    return $build;
  }

}
