<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class UpdateEmployeeUseCase {
  function __construct() {
    $this->repository = new EmployeeRepository();
  }

  function execute($request) {
    $getData = $this->repository->show($request['id']);

    // TODO: update address
    // TODO: update phones
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