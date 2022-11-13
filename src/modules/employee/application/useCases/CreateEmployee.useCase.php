<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class CreateEmployeeUseCase {
  function __construct() {
    $this->employeeRepository = new EmployeeRepository();
    $this->employeeAddressRepository = new EmployeeAddressRepository();
    $this->employeePhoneRepository = new EmployeePhoneRepository();
  }

  function execute($data) {
    $createEmployee = $this->employeeRepository->create($data['employee']);

    $data['address']['employee_id'] = $createEmployee['data']->id;
    
    $createAddress = $this->employeeAddressRepository->create($data['address']);

    foreach ($data['phone'] as $key => $phone) {
      $phone['employee_id'] = $createEmployee['data']->id;
      $addPhone = $this->employeePhoneRepository->create($phone);
    }

    return $data;

    return $createAddress;
  }
}