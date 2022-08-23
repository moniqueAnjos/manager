<?php

namespace App\Interfaces;


interface  EmployeeRepositoryInterface
{
    public function getAllEmployees();
    public function getEmployeeById($employeeId);
    public function createEmployee(array $employeeDetails);
    public function deleteEmployee($employeeId);
    public function editEmployee(array $employeeDetails, $employeeId);
}