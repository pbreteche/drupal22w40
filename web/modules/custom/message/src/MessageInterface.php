<?php

namespace Drupal\message;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a message entity type.
 */
interface MessageInterface extends ContentEntityInterface, EntityOwnerInterface {

}
