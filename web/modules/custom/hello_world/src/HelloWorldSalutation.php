<?php
  namespace Drupal\hello_world;

  use Drupal\Core\StringTranslation\StringTranslationTrait;

  /**
   * Prepares the salutation to the world.
  */

  Class HelloWorldSalutation
  {
    use StringTranslationTrait;

    /**
     * Returns the salutation
    */

    public function getSalutation() {
      $time = new \DateTime();
      if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
        return $this->t('Good Morning World!');
      }

      if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
        return $this->t('Good Afternoon World!');
      }

      if ((int) $time->format('G') >= 18) {
        return $this->t('Good Evening World!');
      }


    }



  }
?>