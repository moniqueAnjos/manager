<?php

namespace App\Http\Controllers;


require_once "app/Services/EmployeeService.php";
require_once "app/Repositories/EmployeeRepository.php";
require_once "app/Http/Requests/EmployeeRequest.php";

use App\Http\Request\EmployeeRequest;
use App\Repositories\EmployeeRepository;
use App\Services\EmployeeService;

class EmployeeController
{
    private EmployeeService $employeeService;
    private EmployeeRequest $employeeRequest;

    public function __construct()
    {
        $this->employeeService = new EmployeeService(new EmployeeRepository);
        $this->employeeRequest = new EmployeeRequest();
    }

    public function getEmployeeById($id)
    {
        $employee = $this->employeeService->getEmployeeById($id[1]);
        $this->employeeRequest->formatResponse(null, 200, $employee);
    }

    public function getAllEmployees()
    {
        $data =  $this->employeeService->getAllEmployees();
        $this->employeeRequest->formatResponse(null, 200, $data);
    }

    public function deleteEmployee($id)
    {
        if ($this->employeeService->deleteEmployee($id[1])) {
            $data =  $this->employeeService->getAllEmployees();
            $this->employeeRequest->formatResponse("Funcionário removido com sucesso!", 200, $data);
        }
    }
    public function saveEmployee()
    {
        $dataArray = $this->commonData();

        if ($this->employeeService->createEmployee($dataArray)) {
            $this->employeeRequest->formatResponse("Dados inseridos com sucesso!", 201, '');
        }
    }
    public function editEmployee($id)
    {
        $dataArray = $this->commonData();
        if ($this->employeeService->editEmployee($dataArray, $id[1])) {
            $this->employeeRequest->formatResponse("Dados alterados com sucesso!", 200, '');
        }
    }

    private function commonData()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $dataArray = $this->employeeRequest->filterUsefulData($data);
        $this->employeeRequest->validateMandatoryData($dataArray);
        return $dataArray;
    }
}
