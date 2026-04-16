<?php

namespace Drupal\store_frontend\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\commerce_product\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

class StoreController extends ControllerBase {

  public function store(Request $request) {

    $limit = 12;

    // =========================
    // PAGINATION
    // =========================
    $page = \Drupal::request()->query->get('page', 0);
    $offset = $page * $limit;

    $storage = \Drupal::entityTypeManager()->getStorage('commerce_product');

    // =========================
    // PRODUCT QUERY
    // =========================
    $query = $storage->getQuery()
      ->accessCheck(TRUE)
      ->condition('status', 1)
      ->sort('created', 'DESC')
      ->range($offset, $limit);

    $pids = $query->execute();
    $products = Product::loadMultiple($pids);

    // =========================
    // FORMAT FOR TWIG
    // =========================
    $items = [];

    foreach ($products as $product) {

      // -------------------------
      // IMAGE
      // -------------------------
      $image_url = NULL;

      if ($product->hasField('field_image') && !$product->get('field_image')->isEmpty()) {
        $file = $product->get('field_image')->entity;
        $image_url = \Drupal::service('file_url_generator')
          ->generateAbsoluteString($file->getFileUri());
      }

      // -------------------------
      // VARIATION (SAFE)
      // -------------------------
      $variation_id = NULL;

      if ($product->hasField('variations') && !$product->get('variations')->isEmpty()) {
        $variation = $product->get('variations')->entity;

        if ($variation) {
          $variation_id = $variation->id();
        }
      }

      // -------------------------
      // FINAL ITEM ARRAY
      // -------------------------
      $items[] = [
        'title' => $product->label(),
        'url' => $product->toUrl()->toString(),
        'image' => $image_url,
        'variation_id' => $variation_id,
      ];
    }

    // =========================
    // TOTAL COUNT
    // =========================
    $total = $storage->getQuery()
        ->accessCheck(TRUE)
        ->condition('status', 1)
        ->count()
        ->execute();

    // =========================
    // RETURN
    // =========================
    return [
        '#theme' => 'store_product_list',
        '#products' => $items,
        '#pager' => [
            '#type' => 'pager',
        ],
    ];
  }
}