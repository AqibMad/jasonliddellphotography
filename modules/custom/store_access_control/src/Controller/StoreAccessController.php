<?php

namespace Drupal\store_access_control\Controller;

use Drupal\Core\Controller\ControllerBase;

class StoreAccessController extends ControllerBase {

  public function pending() {
    return [
      '#markup' => '<h2>Account Pending Approval</h2><p>Your account is not approved by admin yet.</p>',
    ];
  }
}