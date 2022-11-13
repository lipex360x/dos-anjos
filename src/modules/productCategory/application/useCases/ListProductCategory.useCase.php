<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class ListProductCategoryUseCase {
  function __construct() {
    $this->repository = new ProductCategoryRepository();
  }

  function execute() {    
    return array('productCategory' => $this->repository->list());
  }
}