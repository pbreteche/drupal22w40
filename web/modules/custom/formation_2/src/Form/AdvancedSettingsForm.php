<?php

namespace Drupal\formation_2\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Formation 2 settings for this site.
 */
class AdvancedSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'formation_2_advanced_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['formation_2.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Advanced'),
      '#default_value' => $this->config('formation_2.settings')->get('advanced'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('formation_2.settings')
      ->set('advanced', $form_state->getValue('advanced'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
