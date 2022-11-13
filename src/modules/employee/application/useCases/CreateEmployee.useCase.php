<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class CreateEmployeeUseCase {
  function __construct() {
    $this->repository = new EmployeeRepository();
  }

  function execute($data) {    
    return $this->repository->create($data);
  }
}