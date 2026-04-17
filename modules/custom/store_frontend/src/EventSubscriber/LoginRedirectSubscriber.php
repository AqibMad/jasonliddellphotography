<?php

namespace Drupal\store_frontend\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Url;

/**
 * Redirects client role users to /store after login.
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
   * Redirects client role users to store after login.
   */
  public function onRequest(RequestEvent $event) {
    // Only run for master request.
    if (!$event->isMainRequest()) {
      return;
    }

    $request = $event->getRequest();
    $session = $request->getSession();

    // Check if we have already redirected after this login.
    if ($session->get('store_frontend_redirected')) {
      return;
    }

    // Get current route name.
    $current_route = $this->routeMatch->getRouteName();

    // If user is logging in, we check after login. Actually, we need to detect
    // that user just logged in. Better to use a flag set in hook_user_login.
    // But simpler: check if current user is authenticated and has 'client' role,
    // and the current route is not already '/store' or '/user/login' etc.
    if ($this->currentUser->isAuthenticated() &&
        in_array('client', $this->currentUser->getRoles()) &&
        $current_route !== 'store_frontend.store' &&
        $current_route !== 'user.login') {

      // Also avoid redirect if there's a destination parameter.
      if (!$request->query->has('destination')) {
        $url = Url::fromRoute('store_frontend.store')->toString();
        $event->setResponse(new RedirectResponse($url));
        $session->set('store_frontend_redirected', TRUE);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      KernelEvents::REQUEST => ['onRequest', -100], // Low priority.
    ];
  }

}