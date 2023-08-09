<?php

namespace Drupal\hover_card\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Hover Card settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hover_card_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['hover_card.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hover_card.settings');
    $form['personalization'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Personalization'),
    ];
    $form['personalization']['display_email'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable User Emails on Hover'),
      '#default_value' => $config->get('display_email'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('hover_card.settings')->set('display_email', $form_state->getValue('display_email'))->save();
    parent::submitForm($form, $form_state);
  }

}
