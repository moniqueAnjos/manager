<?php

namespace App\Models;

class Employee
{
    public $id;
    public $name;
    public $email;
    public $telephone;
    public $gender;

    public function setEmployee(array $employee)
    {
        $this->name = $employee["name"];
        $this->email = $employee["email"];
        $this->telephone = $employee["telephone"];
        $this->gender = $employee["gender"];
    }
}
