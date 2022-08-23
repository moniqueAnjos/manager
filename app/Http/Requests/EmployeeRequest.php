<?php

namespace App\Http\Request;

class EmployeeRequest
{
    private $attributes = [
        'name' => 'Nome',
        'email' => 'Email',
        'telephone' => 'Telefone',
        'gender' => 'Gênero',
    ];

    public function validateMandatoryData($data)
    {
        foreach ($data as $key => $value) {
            if ($value == '') {
                $msg = "O atributo [" . $this->attributes[$key] . "] é obrigatório.";
                $this->formatResponse($msg, 422, '', true);
            }
        }
    }

    public function filterUsefulData($data)
    {
        $onlyKeys  = array('name', 'email', 'telephone', 'gender');
        $dataArray = array_filter($data, function ($v) use ($onlyKeys) {
            return in_array($v, $onlyKeys);
        }, ARRAY_FILTER_USE_KEY);

        return $dataArray;
    }

    public function formatResponse($msg, $statuscode, $result, $error = false)
    {
        $arrayReturn = [
            'message' => $msg,
            'statusCode' => $statuscode,
            "result" => $result,
            "error" => $error,
        ];
        print json_encode($arrayReturn);
        die;
    }
}
