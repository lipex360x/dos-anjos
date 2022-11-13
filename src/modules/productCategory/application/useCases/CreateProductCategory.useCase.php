<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class CreateProductCategoryUseCase {
  function __construct() {
    $this->repository = new ProductCategoryRepository();
  }

  function execute($data) {

    $getCategory = $this->repository->findByTitle($data['title']);

    if($getCategory) return new WP_Error(400, 'product category is already exists');

    return $this->repository->create($data);
  }
}