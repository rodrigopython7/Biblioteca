<?php

require_once 'DatabaseRepository.php';
require_once 'model/emprestimo.php';

class emprestimoRepository {
    public static function getAllemprestimos() {
        $connection = DatabaseRepository::connect();
        $result = $connection->query("SELECT * FROM emprestimo");

        $emprestimos = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $emprestimo = new emprestimo($row['id'], $row['data_emprestimo'], $row['status']);
                $emprestimos[] = $emprestimo;
            }
        }
        $connection->close();
        return $emprestimos;
    }

    public static function getemprestimoById($id) {
        $connection = DatabaseRepository::connect();
        $result = $connection->query("SELECT * FROM emprestimo WHERE id = $id");

        $emprestimo = null;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $emprestimo = new emprestimo($row['id'], $row['data_emprestimo'], $row['status']);            
        }
        return $emprestimo;
    }

    public static function insertemprestimo(emprestimo $emprestimo) {        
        $connection = DatabaseRepository::connect();

        $data_emprestimo = $emprestimo->getDataemprestimo();
        $status = $emprestimo->getStatus();

        $sql = "INSERT INTO emprestimo (data_emprestimo, status) VALUES ('$data_emprestimo', '$status')";
        $success = $connection->query($sql);
        $connection->close();
        return $success;
    }

    public static function updateemprestimo(emprestimo $emprestimo, $id) {
        $connection = DatabaseRepository::connect();       
        $data_emprestimo = $emprestimo->getDataemprestimo();
        $status = $emprestimo->getStatus();

        $sql = "UPDATE emprestimo SET data_emprestimo = '$data_emprestimo', status = '$status' WHERE id = $id";
        $success = $connection->query($sql);
        $connection->close();
        return $success;
    }

    public static function deleteemprestimo($id) {
        $connection = DatabaseRepository::connect();
        $sql = "DELETE FROM emprestimo WHERE id = $id";
        $success = $connection->query($sql);
        $connection->close();
        return $success;
    }
}
?>