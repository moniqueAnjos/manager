<?php

namespace App\Repositories;

require_once "app/Interfaces/EmployeeRepositoryInterface.php";
require_once "app/Models/Employee.php";
require_once "app/database/DbConexao.php";

use App\Database\DbConexao;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    private Employee $Employee;
    private DbConexao $DbConexao;

    public function __construct()
    {
        $this->Employee = new Employee();
        $this->DbConexao = new DbConexao();
    }

    public function editEmployee($employeeData, $employeeId)
    {
        $sql = "UPDATE employees SET 
        name = '" . $employeeData["name"] . "' ,
         email = '" . $employeeData["email"] . "' ,
         telephone = '" . $employeeData["telephone"] . "' ,
         gender = '" . $employeeData["gender"] . "' 
        WHERE id =" . $employeeId;
        
        return $this->DbConexao->RunQuery($sql);
    }

    public function deleteEmployee($employeeId)
    {
        $sql = "DELETE FROM employees WHERE id =" . $employeeId;
        return $this->DbConexao->RunQuery($sql);
    }

    public function getAllEmployees()
    {
        $sql = "SELECT id, name, email, telephone, gender,
         if(gender='F','Feminino','Masculino') as genderFormat 
         FROM employees order by id desc";
        return $this->DbConexao->RunSelect($sql);
    }

    public function getEmployeeById($employeeId)
    {
        $sql = "SELECT * FROM employees e where id=" . $employeeId;
        return $this->DbConexao->RunSelect($sql);
    }

    public function createEmployee(array $employeeDetails)
    {
        $this->Employee->setEmployee($employeeDetails);

        $sql = "INSERT INTO employees (name, email, telephone, gender) VALUES ('"
            . $this->Employee->name . "', '"
            . $this->Employee->email . "', '"
            . $this->Employee->telephone . "', '"
            . $this->Employee->gender . "')";

        return $this->DbConexao->RunQuery($sql);
    }
}
