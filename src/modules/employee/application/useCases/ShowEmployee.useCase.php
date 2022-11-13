<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class ShowEmployeeUseCase {
  function __construct() {
    $this->employeeRepository = new EmployeeRepository();
    $this->employeeAddressRepository = new EmployeeAddressRepository();
    $this->employeePhoneRepository = new EmployeePhoneRepository();
  }

  function execute($id) {
    $employee = $this->employeeRepository->show($id);

    if(!$employee) return new WP_Error('data', 'data not found', array('status' => 404));

    $address = $this->employeeAddressRepository->findByEmployeeId($employee->id);
    $phones = $this->employeePhoneRepository->findByEmployeeId($employee->id);
    
    $employee->address = $address;
    $employee->phones = $phones;

    return $employee;
  }
}