<?php

/**
 * @file
 * Theme settings form for Settings Theme theme.
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function settings_theme_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['settings_theme'] = [
    '#type' => 'details',
    '#title' => t('Settings Theme'),
    '#open' => TRUE,
  ];

  $form['settings_theme']['font_size'] = [
    '#type' => 'number',
    '#title' => t('Font size'),
    '#min' => 12,
    '#max' => 18,
    '#default_value' => theme_get_setting('font_size'),
  ];

  $form['settings_theme']['link_color'] = [
    '#type' => 'color',
    '#title' => t('Link color'),
    '#default_value' => theme_get_setting('link_color'),
  ];
}
