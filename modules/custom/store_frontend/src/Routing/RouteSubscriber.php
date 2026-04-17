<?php

namespace Drupal\store_frontend\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events and overrides cart page access.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Target the cart page route from Commerce module.
    if ($route = $collection->get('commerce_cart.page')) {
      // Override access with custom access checker.
      $route->setRequirement('_custom_access', '\Drupal\store_frontend\Controller\CartAccessController::access');
    }
  }

}