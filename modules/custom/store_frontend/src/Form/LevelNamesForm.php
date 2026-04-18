<?php

namespace Drupal\store_frontend\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class LevelNamesForm extends ConfigFormBase {

  protected function getEditableConfigNames() {
    return ['store_frontend.settings'];
  }

  public function getFormId() {
    return 'store_frontend_level_names';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('store_frontend.settings');
    for ($i = 1; $i <= 3; $i++) {
      $form["level_{$i}_name"] = [
        '#type' => 'textfield',
        '#title' => $this->t('Level @num Name', ['@num' => $i]),
        '#default_value' => $config->get("level_{$i}_name") ?: "Level $i",
        '#required' => TRUE,
      ];
    }
    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('store_frontend.settings');
    for ($i = 1; $i <= 3; $i++) {
      $config->set("level_{$i}_name", $form_state->getValue("level_{$i}_name"));
    }
    $config->save();
    parent::submitForm($form, $form_state);
  }
}