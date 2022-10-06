<?php

namespace Drupal\formation_3\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\formation_3\Loader\ContactLoader;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a contact count block.
 *
 * @Block(
 *   id = "formation_3_contact_count",
 *   admin_label = @Translation("Contact count"),
 *   category = @Translation("Custom")
 * )
 */
class ContactCountBlock extends BlockBase implements ContainerFactoryPluginInterface {
  public const COUNT_DEFAULT = 5;

  /**
   * The formation_3.contact_loader service.
   *
   * @var \Drupal\formation_3\Loader\ContactLoader
   */
  protected $contactLoader;

  /**
   * Constructs a new ContactCountBlock instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\formation_3\Loader\ContactLoader $contact_loader
   *   The formation_3.contact_loader service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ContactLoader $contact_loader) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->contactLoader = $contact_loader;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('formation_3.contact_loader')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'count' => static::COUNT_DEFAULT,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['count'] = [
      '#type' => 'number',
      '#title' => $this->t('Count'),
      '#default_value' => $this->configuration['count'],
      '#min' => 1,
      '#step' => 1,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['count'] = $form_state->getValue('count');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $contacts = $this->contactLoader->loadAll($this->configuration['count']);

    $build['content'] = [
      '#theme' => 'formation_3_count_block',
      '#contacts' => $contacts,
    ];

    return $build;
  }
}
