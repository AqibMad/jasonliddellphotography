<?php

namespace Drupal\store_access_control\Service;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\user\Entity\User;

class StoreAccess {

  protected AccountProxyInterface $currentUser;

  public function __construct(AccountProxyInterface $current_user) {
    $this->currentUser = $current_user;
  }

  public function isAnonymous(): bool {
    return $this->currentUser->isAnonymous();
  }

  public function canAccess(): bool {
    if ($this->currentUser->isAnonymous()) {
      return FALSE;
    }

    $user = User::load($this->currentUser->id());
    if (!$user) {
      return FALSE;
    }

    if (!$user->hasRole('client')) {
      return FALSE;
    }

    if (!$user->hasField('field_store_approved') || !$user->get('field_store_approved')->value) {
      return FALSE;
    }

    return TRUE;
  }
}