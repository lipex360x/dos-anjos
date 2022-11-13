<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class UpdateProductUseCase {
  function __construct() {
    $this->repository = new ProductRepository();
  }

  function execute($request) {
    $getData = $this->repository->show($request['id']);

    if(!$getData) return new WP_Error('data', 'data not found', array('status' => 404));

    $schema = $this->repository->getSchema();

    $updateData = array();
    foreach ($schema as $value) {
      if(!$request[$value]) continue;

      $updateData[$value] = $request[$value];
    }
  
    return $this->repository->update($request['id'], $updateData);
  }
}