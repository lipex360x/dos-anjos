<?php
require_once plugin_dir_path(__FILE__) . '../../infra/repositories/index.php';

class ListEmployeeUseCase {
  function __construct() {
    $this->employeeRepository = new EmployeeRepository();
    $this->employeeAddressRepository = new EmployeeAddressRepository();
    $this->employeePhoneRepository = new EmployeePhoneRepository();
  }

  function execute() {
    $getEmployees = $this->employeeRepository->list();

    $fromDomainToUseCase = array();
    foreach ($getEmployees as $employee) {
      $address = $this->employeeAddressRepository->findByEmployeeId($employee->id);
      $phones = $this->employeePhoneRepository->findByEmployeeId($employee->id);
      
      $employee->address = $address;
      $employee->phones = $phones;

      array_push($fromDomainToUseCase, $employee);
    }

    return array('employees' => $fromDomainToUseCase);
  }
}