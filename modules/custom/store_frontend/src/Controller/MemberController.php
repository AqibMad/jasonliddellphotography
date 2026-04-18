<?php

namespace Drupal\store_frontend\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\commerce_product\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

class MemberController extends ControllerBase {

  /**
   * Display member products based on user's level (downward access).
   */
  public function members(Request $request) {
    $current_user = $this->currentUser();
    $max_level = store_frontend_get_user_max_member_level($current_user);
    
    if ($max_level == 0) {
      // No member role – access should have been denied, but just in case.
      return ['#markup' => $this->t('Access denied.')];
    }

    // Load all products of type 'member_product' (or your product type)
    $product_storage = $this->entityTypeManager()->getStorage('commerce_product');
    $query = $product_storage->getQuery()
      ->accessCheck(TRUE)
      ->condition('type', 'member_product')  // <-- change to your product type machine name
      ->condition('status', 1)
      ->sort('field_member_level', 'ASC');   // level 1, then 2, then 3

    // Apply downward access: only products with level <= user's max level
    $or_group = $query->orConditionGroup();
    for ($i = 1; $i <= $max_level; $i++) {
      $or_group->condition('field_member_level', $i);
    }
    $query->condition($or_group);
    
    $pids = $query->execute();
    $products = Product::loadMultiple($pids);

    $items = [];
    foreach ($products as $product) {
      $image_url = NULL;
      if ($product->hasField('field_image') && !$product->get('field_image')->isEmpty()) {
        $file = $product->get('field_image')->entity;
        if ($file) {
          $image_url = $this->fileUrlGenerator()->generateAbsoluteString($file->getFileUri());
        }
      }

      // Build add to cart form for this product
      $cart_form = $this->buildAddToCartForm($product);

      // Get display name of the level (from config)
      $level_num = $product->get('field_member_level')->value;
      $level_name = store_frontend_get_level_name($level_num);

      $items[] = [
        'id' => $product->id(),
        'title' => $product->label(),
        'level_name' => $level_name,
        'image' => $image_url,
        'cart_form' => $cart_form,
        'url' => $product->toUrl()->toString(),
      ];
    }

    return [
      '#theme' => 'member_products_list',
      '#products' => $items,
      '#user_level' => $max_level,
      '#user_level_name' => store_frontend_get_level_name($max_level),
    ];
  }

  /**
   * Build add to cart form for a product.
   */
  protected function buildAddToCartForm($product) {
    $entity_type_manager = $this->entityTypeManager();
    $form_builder = $this->formBuilder();

    $default_variation = $product->getDefaultVariation();
    if (!$default_variation) {
      return [];
    }

    $order_item_storage = $entity_type_manager->getStorage('commerce_order_item');
    $order_item = $order_item_storage->createFromPurchasableEntity($default_variation);

    $form_object = $entity_type_manager->getFormObject('commerce_order_item', 'add_to_cart');
    $form_object->setEntity($order_item);

    $form_state = new \Drupal\Core\Form\FormState();
    $form_state->setFormState([
      'product' => $product,
      'view_mode' => 'default',
      'settings' => ['combine' => TRUE],
    ]);
    $form_state->setRedirect('commerce_cart.page');

    return $form_builder->buildForm($form_object, $form_state);
  }

  /**
   * Access callback: only member roles (level 1/2/3) can access.
   */
  public function access(AccountInterface $account) {
    $max_level = store_frontend_get_user_max_member_level($account);
    if ($max_level > 0) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }
}