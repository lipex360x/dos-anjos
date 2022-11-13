<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class ListEmployeeUseCase {
  function __construct() {
    $this->repository = new EmployeeRepository();
  }

  function execute() {    
    return array('employee' => $this->repository->list());
  }
}