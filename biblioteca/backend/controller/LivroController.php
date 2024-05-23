<?php

require_once 'database/livroRepository.php';

class livroController {
    public static function handleRequest($action) {
        switch ($action) {
            case 'listar':
                self::listarlivros();
                break;
            case 'buscar':
                self::buscarlivroPorId();
                break;
            case 'cadastrar':
                self::cadastrarlivro();
                break;
            case 'atualizar':
                self::atualizarlivro();
                break;
            case 'excluir':
                self::excluirlivro();
                break;
            default:
                http_response_code(400);
                echo json_encode(['error' => 'Ação inválida!']);
                break;
        }
    }

    public static function listarlivros() {
        $livros = livro::getAlllivros();
        echo json_encode($livros);
    }

    public static function buscarlivroPorId() {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $livro = livro::getlivroById($id);

            if($livro) {
                echo json_encode($livro);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'livro não econtrado']);
            }
        } else {
            http_response_code(405); 
        }
    }

    public static function cadastrarlivro() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ano = json_decode(file_get_contents("php://input"));
            $livro = new livro(null, $ano->titulo, $ano->autor, $ano->isbn);

            $success = livro::insertlivro($livro);
            echo json_encode(['success' => $success]);
        } else {
            http_response_code(405);
        }
    }

    public static function atualizarlivro() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ano = json_decode(file_get_contents("php://input"));
            $livro = new livro($ano->id, $ano->titulo, $ano->autor, $ano->isbn);

            $success = livro::updatelivro($livro);
            echo json_encode(['success' => $success]);
        } else {
            http_response_code(405);
        }
    }

    public static function excluirlivro() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ano = json_decode(file_get_contents("php://input"));
            $id = $ano->id;

            $success = livro::deletelivro($id);
            echo json_encode(['success' => $success]);
        } else {
            http_response_code(405);
        }
    }
}
?>