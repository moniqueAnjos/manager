<?php

namespace App\Services;

use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeService
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function editEmployee($employeeData, $employeeId)
    {
        return $this->employeeRepository->editEmployee($employeeData, $employeeId);
    }

    public function deleteEmployee($employeeId)
    {
        return $this->employeeRepository->deleteEmployee($employeeId);
    }

    public function createEmployee($employeeData)
    {
        return $this->employeeRepository->createEmployee($employeeData);
    }

    public function getEmployeeById($employeeId)
    {
        return $this->employeeRepository->getEmployeeById($employeeId);
    }

    public function getAllEmployees()
    {
        return $this->employeeRepository->getAllEmployees();
    }
}