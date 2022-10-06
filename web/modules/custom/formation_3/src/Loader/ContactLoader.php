<?php

namespace Drupal\formation_3\Loader;

use Drupal\Core\Database\Connection;

class ContactLoader {

  private Connection $connection;

  public function __construct(Connection $database) {

    $this->connection = $database;
  }

  public function load(int $id) {
    $query = $this->connection->query(
      'SELECT id, uid, first_name, last_name, email, description, phone'.
      ' FROM {formation_3_contact}'.
      ' WHERE id = :id', [':id' => $id]
    );

    return $query->fetchObject();
  }

  public function loadAll() {
    $query = $this->connection->query(
      'SELECT id, uid, first_name, last_name, email, description, phone FROM {formation_3_contact}'
    );

    return $query->fetchAll();
  }
}
