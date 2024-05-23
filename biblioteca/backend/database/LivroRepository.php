<?php
require_once 'DatabaseRepository.php';
require_once 'model/livro.php';

class livroRepository {
    public static function getAlllivros() {
        $connection = DatabaseRepository::connect();
        $result = $connection->query("SELECT * FROM livro");

        $livros = [];        
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $livro = new livro($row['id'], $row['titulo'], $row['autor'], $row['ano'], $row['isbn']);
                $livros[] = $livro;
            }
        }
        $connection->close();
        return $livros;
    }

    public static function getlivroById($id) {
        $connection = DatabaseRepository::connect();
        $result = $connection->query("SELECT * FROM livro WHERE id = $id");

        $livro = null;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $livro = new livro($row['id'], $row['titulo'], $row['autor'], $row['ano'], $row['isbn']);
        }
        $connection->close();
        return $livro;
    }

    public static function insertlivro(livro $livro) {
        $connection = DatabaseRepository::connect();

        $titulo = $livro->gettitulo();
        $autor = $livro->getautor();
        $ano = $livro->getano();
        $isbn = $livro->getisbn();

        $sql = "INSERT INTO livro (titulo, autor, isbn) VALUES ('$titulo', '$autor', '$ano', '$isbn')";
        $success = $connection->query($sql);
        $connection->close();
        return $success;
    }

    public static function updatelivro(livro $livro) {
        $connection = DatabaseRepository::connect();
        $id = $livro->getId();
        $titulo = $livro->gettitulo();
        $autor = $livro->getautor();
        $ano = $livro->getano();
        $isbn = $livro->getisbn();

        $sql = "UPDATE livro SET titulo='$titulo', autor='$autor', ano='$ano' isbn='$isbn'
                WHERE id=$id";
        $success = $connection->query($sql);
        $connection->close();

        return $success;
    }

    public static function deletelivro($id) {
        $connection = DatabaseRepository::connect();
        $success = $connection->query("DELETE FROM livro WHERE id=$id");
        $connection->close();
        return $success;
    }
}
?>