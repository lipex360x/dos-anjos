<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class ListProductUseCase {
  function __construct() {
    $this->repository = new ProductRepository();
  }

  function execute() {   
    // TODO: list by category 
    return array('product' => $this->repository->list());
  }
}