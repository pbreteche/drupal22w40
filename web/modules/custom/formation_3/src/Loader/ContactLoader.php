<?php

namespace Drupal\formation_3\Loader;

use Drupal\Core\Database\Connection;

class ContactLoader {

  private Connection $connection;

  public function __construct(Connection $database) {

    $this->connection = $database;
  }

  public function loadAll() {
    $query = $this->connection->select('formation_3_contact')
      ->fields('formation_3_contact', ['id', 'uid', 'first_name', 'last_name', 'email', 'description', 'phone'])
    ;

    return $query->execute()->fetchAll();
  }
}
