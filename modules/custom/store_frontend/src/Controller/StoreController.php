<?php

namespace Drupal\store_frontend\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\commerce_product\Entity\Product;
use Drupal\Core\Form\FormState;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

class StoreController extends ControllerBase {

  public function store(Request $request) {
    $limit = 12;

    $page = (int) $request->query->get('page', 0);
    $offset = $page * $limit;

    $storage = \Drupal::entityTypeManager()->getStorage('commerce_product');
    $query = $storage->getQuery()
      ->accessCheck(TRUE)
      ->condition('status', 1)
      ->sort('created', 'DESC')
      ->range($offset, $limit);

    // --- Client role filtering ---
    $current_user = \Drupal::currentUser();
    if (in_array('client', $current_user->getRoles())) {
      $user_id = $current_user->id();
      // Sirf wahi products jinme current user assigned hai.
      $query->condition('field_assigned_clients', $user_id);
    }
    // Admin aur others ke liye koi condition nahi, sab products dikhenge.

    $pids = $query->execute();
    $products = Product::loadMultiple($pids);

    $items = [];
    $current_langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();

    foreach ($products as $product) {
      $image_url = NULL;

      if ($product->hasField('field_image') && !$product->get('field_image')->isEmpty()) {
        $file = $product->get('field_image')->entity;
        if ($file) {
          $image_url = \Drupal::service('file_url_generator')
            ->generateAbsoluteString($file->getFileUri());
        }
      }

      $cart_form = $this->buildAddToCartForm($product, $current_langcode);

      $items[] = [
        'id' => $product->id(),
        'title' => $product->label(),
        'url' => $product->toUrl()->toString(),
        'image' => $image_url,
        'cart_form' => $cart_form,
      ];
    }

    return [
      '#theme' => 'store_product_list',
      '#products' => $items,
      '#pager' => [
        '#type' => 'pager',
      ],
    ];
  }

  protected function buildAddToCartForm($product, $langcode = NULL) {
    $entity_type_manager = \Drupal::entityTypeManager();
    $form_builder = \Drupal::formBuilder();

    if ($langcode) {
      $product = \Drupal::service('entity.repository')
        ->getTranslationFromContext($product, $langcode);
    }

    $default_variation = $product->getDefaultVariation();
    if (!$default_variation) {
      return [];
    }

    $order_item_storage = $entity_type_manager->getStorage('commerce_order_item');
    $order_item = $order_item_storage->createFromPurchasableEntity($default_variation);

    $form_object = $entity_type_manager->getFormObject('commerce_order_item', 'add_to_cart');
    $form_object->setEntity($order_item);

    $form_object->setFormId($form_object->getBaseFormId() . '_commerce_product_' . $product->id());

    $form_state = (new FormState())->setFormState([
      'product' => $product,
      'view_mode' => 'default',
      'settings' => [
        'combine' => TRUE,
      ],
    ]);

    // Set redirect destination to cart page after add to cart
    $form_state->setRedirect('commerce_cart.page');

    return $form_builder->buildForm($form_object, $form_state);
  }

  public function access(AccountInterface $account) {
    $allowed_roles = ['administrator', 'client'];
    $user_roles = $account->getRoles();
    if (array_intersect($allowed_roles, $user_roles)) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }

}