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
    if (!$event->isMainRequest()) {
      return;
    }

    $request = $event->getRequest();
    $session = $request->getSession();

    if ($session->get('store_frontend_redirected')) {
      return;
    }

    $current_route = $this->routeMatch->getRouteName();
    $user = $this->currentUser;

    if ($user->isAuthenticated()) {
      $roles = $user->getRoles();
      $redirect_url = NULL;

      // Client role -> /store
      if (in_array('client', $roles) && $current_route !== 'store_frontend.store' && $current_route !== 'user.login') {
        $redirect_url = Url::fromRoute('store_frontend.store')->toString();
      }
      // Member role (level 1,2,3) -> /members
      elseif (store_frontend_get_user_max_member_level($user) > 0 && $current_route !== 'store_frontend.members' && $current_route !== 'user.login') {
        $redirect_url = Url::fromRoute('store_frontend.members')->toString();
      }

      if ($redirect_url && !$request->query->has('destination')) {
        $event->setResponse(new RedirectResponse($redirect_url));
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