<?php

namespace Drupal\store_frontend\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Form\FormState;
use Drupal\Core\Url;
use Drupal\commerce_product\Entity\Product;
use Drupal\commerce_product\Entity\ProductInterface;
use Symfony\Component\HttpFoundation\Request;

class MemberController extends ControllerBase {

  /**
   * Display member products based on membership level hierarchy.
   * Level 3 sees 1, 2, and 3; level 2 sees 1 and 2; level 1 sees only 1.
   */
  public function members(Request $request) {
    $current_user = $this->currentUser();
    $user_level = (int) store_frontend_get_user_max_member_level($current_user);

    if ($user_level <= 0) {
      return [
        '#markup' => $this->t('Access denied.'),
      ];
    }

    $product_storage = $this->entityTypeManager()->getStorage('commerce_product');

    // 🔥 Strict filtering at query level (best performance)
    // Inclusive membership: allow products for any level <= current user level.
    $query = $product_storage->getQuery()
      ->accessCheck(FALSE)
      ->condition('type', 'member_product')
      ->condition('status', 1)
      ->condition('field_member_level', $user_level, '<=')
      ->sort('created', 'DESC');

    $pids = $query->execute();

    if (empty($pids)) {
      return [
        '#markup' => $this->t('No membership product available for your level.'),
      ];
    }

    $products = Product::loadMultiple($pids);

    $items = [];

    foreach ($products as $product) {

      // 🔒 Extra safety (avoid broken data)
      if (!$product instanceof ProductInterface) {
        continue;
      }

      $level_num = (int) ($product->get('field_member_level')->value ?? 0);

      if ($level_num > $user_level) {
        continue;
      }

      // 🖼 Image handling
      $image_url = NULL;
      if ($product->hasField('field_image') && !$product->get('field_image')->isEmpty()) {
        $file = $product->get('field_image')->entity;
        if ($file) {
          $image_url = $this->fileUrlGenerator()
            ->generateAbsoluteString($file->getFileUri());
        }
      }

      // 🛒 Add to cart form
      $uid = $current_user->id();
      $level_num = (int) ($product->get('field_member_level')->value ?? 0);

      // Purchase check (LEVEL-based)
      $has_membership = store_frontend_member_has_active_membership($uid, $level_num);

      $is_locked = TRUE;
      $cart_form = NULL;

      if ($has_membership) {
        $is_locked = FALSE;
      } else {
        $cart_form = $this->buildAddToCartForm($product);
      }

      // 🏷 Level label from config/helper
      $level_name = store_frontend_get_level_name($level_num);

      $items[] = [
        'id' => $product->id(),
        'title' => $product->label(),
        'level_name' => $level_name,
        'image' => $image_url,
        'cart_form' => $cart_form,
        'is_locked' => $is_locked,
        'url' => Url::fromRoute('store_frontend.member_product', ['product_id' => $product->id()])->toString(),
      ];
    }

    return [
      '#theme' => 'member_products_list',
      '#products' => $items,
      '#user_level' => $user_level,
      '#user_level_name' => store_frontend_get_level_name($user_level),
      '#cache' => [
        'contexts' => ['user.roles'], // ✅ important for role-based rendering
      ],
    ];
  }

  /**
   * Build add to cart form safely.
   */
  protected function buildAddToCartForm($product) {
    $entity_type_manager = $this->entityTypeManager();
    $form_builder = $this->formBuilder();

    // ✅ Ensure correct type
    if (!$product instanceof ProductInterface) {
      return [];
    }

    // ✅ Ensure variation exists
    $default_variation = $product->getDefaultVariation();
    if (!$default_variation) {
      \Drupal::logger('store_frontend')->warning('Product @id has no variation.', [
        '@id' => $product->id(),
      ]);
      return [];
    }

    // ✅ Create order item
    $order_item_storage = $entity_type_manager->getStorage('commerce_order_item');
    $order_item = $order_item_storage->createFromPurchasableEntity($default_variation);

    // ✅ Build Commerce form
    $form_object = $entity_type_manager->getFormObject('commerce_order_item', 'add_to_cart');
    $form_object->setEntity($order_item);

    $form_state = new FormState();

    // 🔥 CRITICAL: Required by Drupal Commerce internals
    $form_state->setFormState([
      'product' => $product,
      'view_mode' => 'default',
      'settings' => [
        'combine' => TRUE,
      ],
    ]);

    $form_state->setRedirect('commerce_cart.page');

    return $form_builder->buildForm($form_object, $form_state);
  }

  /**
   * Access control: only members allowed.
   */
  public function access(AccountInterface $account) {
    $level = (int) store_frontend_get_user_max_member_level($account);

    return $level > 0
      ? AccessResult::allowed()
      : AccessResult::forbidden();
  }

  /**
   * Display single member product.
   */
  public function memberProduct($product_id) {
    $current_user = $this->currentUser();
    $user_level = (int) store_frontend_get_user_max_member_level($current_user);

    if ($user_level <= 0) {
      return [
        '#markup' => $this->t('Access denied.'),
      ];
    }

    $product = Product::load($product_id);
    if (!$product || $product->bundle() !== 'member_product') {
      return [
        '#markup' => $this->t('Product not found.'),
      ];
    }

    // Allow access to any product at or below the user's membership level.
    $product_level = (int) ($product->get('field_member_level')->value ?? 0);
    if ($product_level > $user_level) {
      return [
        '#markup' => $this->t('Access denied to this product.'),
      ];
    }

    // Check if user has active membership
    $uid = $current_user->id();
    $has_membership = store_frontend_member_has_active_membership($uid, $product_level);

    // Build product data
    $image_url = NULL;
    if ($product->hasField('field_image') && !$product->get('field_image')->isEmpty()) {
      $file = $product->get('field_image')->entity;
      if ($file) {
        $image_url = $this->fileUrlGenerator()
          ->generateAbsoluteString($file->getFileUri());
      }
    }

    $cart_form = NULL;
    if (!$has_membership) {
      $cart_form = $this->buildAddToCartForm($product);
    }

    $level_name = store_frontend_get_level_name($product_level);

    return [
      '#theme' => 'member_product_single',
      '#product' => [
        'id' => $product->id(),
        'title' => $product->label(),
        'body' => $product->get('body')->value ?? '',
        'level_name' => $level_name,
        'image' => $image_url,
        'cart_form' => $cart_form,
        'has_membership' => $has_membership,
      ],
      '#cache' => [
        'contexts' => ['user.roles'],
      ],
    ];
  }

}