<?php

namespace Drupal\store_frontend\EventSubscriber;

use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Redirects users after login based on role.
 */
class LoginRedirectSubscriber implements EventSubscriberInterface {

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\CurrentRouteMatch
   */
  protected $routeMatch;

  /**
   * Constructs a new LoginRedirectSubscriber.
   */
  public function __construct(AccountProxyInterface $current_user, CurrentRouteMatch $route_match) {
    $this->currentUser = $current_user;
    $this->routeMatch = $route_match;
  }

  /**
   * Redirect after login only.
   */
  public function onRequest(RequestEvent $event) {
    if (!$event->isMainRequest()) {
      return;
    }

    $request = $event->getRequest();
    $current_route = $this->routeMatch->getRouteName();

    // Only run on login route.
    if ($current_route !== 'user.login') {
      return;
    }

    $user = $this->currentUser;

    if (!$user->isAuthenticated()) {
      return;
    }

    $roles = $user->getRoles();
    $redirect_url = NULL;

    // Member roles first.
    if (store_frontend_get_user_max_member_level($user) > 0) {
      $redirect_url = Url::fromRoute('store_frontend.members')->toString();
    }
    // Client role.
    elseif (in_array('client', $roles, TRUE)) {
      $redirect_url = Url::fromRoute('store_frontend.store')->toString();
    }

    if ($redirect_url) {
      $event->setResponse(new RedirectResponse($redirect_url));
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      KernelEvents::REQUEST => ['onRequest', -100],
    ];
  }

}