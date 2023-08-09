<?php

namespace Drupal\hover_card\Controller;

use Drupal\Component\Utility\Html;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\RendererInterface;
use Drupal\user\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Returns responses for Hover Card routes.
 */
class HoverCardController extends ControllerBase {

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * The hover card controller constructor.
   *
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer.
   */
  public function __construct(RendererInterface $renderer) {
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('renderer')
    );
  }

  /**
   * Builds the response.
   *
   * @param \Drupal\user\UserInterface $user
   *   The user object.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   The user data.
   */
  public function build(UserInterface $user) {
    $roles = [];
    $mail = $picture = "";
    $name = $user->getDisplayName();

    if ($user->getEmail() && $this->config('hover_card.settings')->get('display_email')) {
      $mail = $user->getEmail();
    }

    if ($user->id()) {
      if (!$user->get('user_picture')->isEmpty()) {
        $picture = $user->get('user_picture')->view('thumbnail');
      }
    }

    foreach ($user->getRoles() as $value) {
      $roles[] = Html::escape($value);
    }

    $user_data = [
      'name' => Html::escape($name),
      'mail' => Html::escape($mail),
      'picture' => $picture,
      'roles' => implode(', ', $roles),
    ];

    $hover_card_template_build = [
      '#theme' => 'hover_card',
      '#details' => $user_data,
    ];

    $response = new Response();
    $response->setContent($this->renderer->render($hover_card_template_build));
    return $response;
  }

}
