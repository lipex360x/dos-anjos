<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class DeleteEmployeeUseCase {
  function __construct() {
    $this->repository = new EmployeeRepository();
  }

  function execute($id) {
    $getData = $this->repository->show($id);

    if(!$getData) return new WP_Error('data', 'data not found', array('status' => 404));
    
    return $this->repository->delete($id);
  }
}