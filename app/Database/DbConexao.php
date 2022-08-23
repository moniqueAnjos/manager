<?php

namespace App\Database;

use Exception;
use PDO;
use PDOException;

set_time_limit(200);
set_time_limit(200);
class DbConexao
{

    private function Connect()
    {
        $host = "127.0.0.1";
        $dbname = "db_gestao";
        $username = "root";
        $link = new PDO("mysql:host=$host;dbname=$dbname", $username, '');

        if (!$link) {
            print "Error: Falha ao conectar-se com o banco de dados MySQL.";
            exit;
        }
        return $link;
    }

    public function RunQuery($sql)
    {
        $stm = $this->Connect()->prepare($sql);
        $executou = $stm->execute();
        $this->linhasAfetadas = $stm->rowCount();
        if (!$executou) {
            $erro = $stm->errorInfo();
            print $erro;
            die;
        }
        return $executou;
    }

    public function RunSelect($sql)
    {
        $stm = $this->Connect()->prepare($sql);
        if (empty($stm)) {
            print "Consulta inválida";
            die;
        }
        $stm->execute();

        $rs = @$stm->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}
