<?php

namespace Drupal\message\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\message\MessageInterface;

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
      '#cache' => [
        'tags' => ['message_list']
      ],
    ];

    return $build;
  }
  /**
   * Builds the response.
   */
  public function inbox() {
    $messageStorage = $this->entityTypeManager()->getStorage('message');

    $messageIds = $messageStorage
      ->getQuery()
      ->accessCheck()
      ->condition('recipients', \Drupal::currentUser()->id(), 'IN')
      ->condition('sent', TRUE)
      ->execute()
    ;

    $messages = $messageStorage->loadMultiple($messageIds);

    $build['content'] = [
      '#theme' => 'message-box',
      '#messages' => $messages,
      '#cache' => [
        'tags' => ['message_list']
      ],
    ];

    return $build;
  }

  public function isOwner(MessageInterface $message) {
    return $message->get('uid') == \Drupal::currentUser()->id();
  }

  public function send(MessageInterface $message) {
    $message->set('sent', TRUE);
    $this->entityTypeManager()->getStorage('message')->save($message);

    return $this->redirect('entity.message.canonical', ['message' => $message->id()]);
  }
}
