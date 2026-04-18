<?php

namespace Drupal\store_frontend\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Controller\ControllerBase;

class CartAccessController extends ControllerBase {

  public function access(AccountInterface $account) {
    // Allowed roles: admin, client, and all member levels
    $allowed_roles = ['administrator', 'client', 'member_level_1', 'member_level_2', 'member_level_3'];
    $user_roles = $account->getRoles();
    if (array_intersect($allowed_roles, $user_roles)) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }

}