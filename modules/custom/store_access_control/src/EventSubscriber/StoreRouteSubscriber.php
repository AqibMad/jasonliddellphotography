<?php

namespace Drupal\store_access_control\EventSubscriber;

use Drupal\Core\Routing\LocalRedirectResponse;
use Drupal\Core\Url;
use Drupal\store_access_control\Service\StoreAccess;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class StoreRouteSubscriber implements EventSubscriberInterface {

  protected StoreAccess $access;

  public function __construct(StoreAccess $access) {
    $this->access = $access;
  }

  public static function getSubscribedEvents(): array {
    return [
      KernelEvents::REQUEST => ['onRequest', 30],
    ];
  }

  public function onRequest(RequestEvent $event): void {
    if (!$event->isMainRequest()) {
      return;
    }

    $request = $event->getRequest();
    $path = $request->getPathInfo();

    // Public pages that must stay accessible.
    $allowed_paths = [
      '/user/login',
      '/user/register',
      '/user/logout',
      '/store/pending-approval',
    ];

    foreach ($allowed_paths as $allowed) {
      if ($path === $allowed || str_starts_with($path, $allowed . '/')) {
        return;
      }
    }

    // Protect store-related paths.
    $protected_paths = [
      '/store',
      '/cart',
      '/checkout',
    ];

    $is_protected = FALSE;
    foreach ($protected_paths as $protected) {
      if ($path === $protected || str_starts_with($path, $protected . '/')) {
        $is_protected = TRUE;
        break;
      }
    }

    if (!$is_protected) {
      return;
    }

    if ($this->access->canAccess()) {
      return;
    }

    $target_route = $this->access->isAnonymous()
      ? 'user.login'
      : 'store_access_control.pending';

    $target = Url::fromRoute($target_route)->toString();

    $event->setResponse(new LocalRedirectResponse($target));
  }

}