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
        try {
            $host = "127.0.0.1";
            $dbname = "db_gestao";
            $username = "root";
            $link = new PDO("mysql:host=$host;dbname=$dbname", $username, '');

            if (!$link) {
                echo "Error: Falha ao conectar-se com o banco de dados MySQL.";
                exit;
            }
            return $link;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function RunQuery($sql)
    {
        try {
            $stm = $this->Connect()->prepare($sql);
            $executou = $stm->execute();
            $this->linhasAfetadas = $stm->rowCount();
            if (!$executou) {
                $erro = $stm->errorInfo();
                return $erro;
            } 
            return $executou;
        } catch (PDOException $e) {
            echo "Erro ao tentar manipular dados: ", $e->getMessage(), "\n";
            die;
        }
    }

    public function RunSelect($sql)
    {
        try {
            $stm = $this->Connect()->prepare($sql);
            if (empty($stm)) {
                print "Consulta inválida";
                die;
            }
            $stm->execute();

            $rs = @$stm->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (Exception $e) {

            print "Desculpe, mas nao houve comunicacao com o banco de dados. Por favor recarregue a pagina e tente novamente.";
            die;
        }
    }
}
