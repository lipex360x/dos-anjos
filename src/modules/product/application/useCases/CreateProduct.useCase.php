<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class CreateProductUseCase {
  function __construct() {
    $this->repository = new ProductRepository();
  }

  function execute($data) {    
    return $this->repository->create($data);
  }
}