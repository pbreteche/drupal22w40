<?php

namespace Drupal\formation_3\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\formation_3\Loader\ContactLoader;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Formation 3 routes.
 */
class Formation3Controller extends ControllerBase {

  /**
   * @var \Drupal\formation_3\Loader\ContactLoader
   */
  private ContactLoader $loader;

  public function __construct(ContactLoader $loader) {
    $this->loader = $loader;
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('formation_3.contact_loader'));
  }

  /**
   * Builds the response.
   */
  public function index() {

    $contacts = $this->loader->loadAll();

    $build['content'] = [
      '#theme' => 'formation_3_index',
      '#contacts' => $contacts,
    ];

    return $build;
  }

  public function show($contact) {
    $build['content'] = [
      '#theme' => 'formation_3_show',
      '#contact' => $contact,
    ];

    return $build;
  }

  public function showTitle($contact) {
    return $contact->first_name.' '.strtoupper($contact->last_name);
  }
}
