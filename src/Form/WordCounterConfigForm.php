<?php

namespace Drupal\word_counter\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WordCounterConfigForm
 * @package Drupal\word_counter\Form
 */
class WordCounterConfigForm extends ConfigFormBase {

  /**
   * Config name.
   */
  public const CONFIG_NAME = 'word_counter.settings';

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [static::CONFIG_NAME];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'word_counter_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config(static::CONFIG_NAME);

    $form['word_counter'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use word counter'),
      '#default_value' => $config->get('word_counter') ?? TRUE,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {

    // Save config values.
    $config = $this->config(static::CONFIG_NAME);
    $config->set('word_counter', $form_state->getValue('word_counter'));
    $config->save();
    parent::submitForm($form, $form_state);
  }

}
