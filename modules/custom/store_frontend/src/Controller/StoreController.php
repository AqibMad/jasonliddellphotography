<?php

namespace Drupal\store_frontend\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\commerce_product\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Pager\PagerManagerInterface;

class StoreController extends ControllerBase {

  public function store(Request $request) {

    $limit = 12;

    // Page number from URL (?page=1,2,3...)
    $page = \Drupal::request()->query->get('page', 0);

    $offset = $page * $limit;

    // Product Query
   $storage = \Drupal::entityTypeManager()->getStorage('commerce_product');

    $query = $storage->getQuery()
    ->accessCheck(TRUE)   // ✅ REQUIRED
    ->condition('status', 1)
    ->sort('created', 'DESC')
    ->range($offset, $limit);

    $pids = $query->execute();
    $products = Product::loadMultiple($pids);

    // Total count
    $total = $storage->getQuery()
    ->accessCheck(TRUE)   // ✅ REQUIRED
    ->condition('status', 1)
    ->count()
    ->execute();

    // Drupal pager system
    $pager_manager = \Drupal::service('pager.manager');
    $pager = $pager_manager->createPager($total, $limit);

    return [
      '#theme' => 'store_product_list',
      '#products' => $products,
      '#pager' => [
        '#type' => 'pager',
      ],
    ];
  }
}