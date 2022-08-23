<?php
require_once "app/Route/Route.php";

use App\Route\Route;

(!Route::requestMethod('GET')) ?: $rotas['employeeAll'] = "app\\Http\\Controllers\\EmployeeController\\getAllEmployees";
(!Route::requestMethod('GET')) ?: $rotas['employee'] = "app\\Http\\Controllers\\EmployeeController\\getEmployeeById";
(!Route::requestMethod('POST')) ?: $rotas['employee'] = "app\\Http\\Controllers\\EmployeeController\\saveEmployee";
(!Route::requestMethod('PUT')) ?: $rotas['employee'] = "app\\Http\\Controllers\\EmployeeController\\editEmployee";
(!Route::requestMethod('DELETE')) ?: $rotas['employee'] = "app\\Http\\Controllers\\EmployeeController\\deleteEmployee";
