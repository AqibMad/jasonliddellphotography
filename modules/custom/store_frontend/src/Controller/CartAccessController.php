<?php

namespace Drupal\store_frontend\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Controller\ControllerBase;

/**
 * Provides access checks for cart page.
 */
class CartAccessController extends ControllerBase {

  /**
   * Checks access for cart page.
   */
  public function access(AccountInterface $account) {
    $allowed_roles = ['administrator', 'client'];
    $user_roles = $account->getRoles();
    if (array_intersect($allowed_roles, $user_roles)) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }

}