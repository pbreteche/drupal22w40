<?php

namespace Drupal\formation_3\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a confirmation form before clearing out the examples.
 */
class ContactDeleteConfirmForm extends ConfirmFormBase {

  /**
   * @var Connection
   */
  private Connection $connection;

  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'formation_3_contact_delete_confirm';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete this contact?');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $contact = NULL) {
    $form = parent::buildForm($form, $form_state);
    $form_state->setStorage(['contact_id' => $contact->id]);
    $form['description'] = [
      '#markup' => $this->t('Contact: @contactName', ['@contactName' => $contact->first_name.' '.$contact->last_name])];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('formation_3.example');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->connection
      ->delete('formation_3_contact')
      ->condition('id', $form_state->getStorage()['contact_id'])
      ->execute()
    ;
    $this->messenger()->addStatus($this->t('Done!'));
    $form_state->setRedirectUrl(new Url('formation_3.example'));
  }
}
