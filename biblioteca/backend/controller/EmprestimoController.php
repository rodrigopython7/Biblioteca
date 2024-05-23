<?php
require_once 'database/emprestimoRepository.php';

class emprestimoController {
    public static function handleRequest($action) {
        switch($action) {
            case 'listar':
                self::listaremprestimos();
                break;
            case 'buscar':
                self::buscaremprestimoPorId();
                break;
            case 'cadastrar':
                self::cadastraremprestimo();
                break;
            case 'atualizar':
                self::atualizaremprestimo();
                break;
            case 'excluir':
                self::excluiremprestimo();
                break;
            default:
                http_response_code(400); // Requisição inválida
                echo json_encode(['error' => 'Ação inválida']);
                break;
        }
    }

    public static function listaremprestimos() {
        $emprestimos = emprestimoRepository::getAllemprestimos();
        echo json_encode($emprestimos);
    }

    public static function buscaremprestimoPorId() {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $emprestimo = emprestimoRepository::getemprestimoById($id);

            if($emprestimo) {

            } else {
                http_response_code(404);
                echo json_encode(['error' => "emprestimo não encontrado!"]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['método não permitido' => 'Essa requisição só aceita GET']);
        }
    }

    public static function cadastraremprestimo() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));
            $data_emprestimo = $data->data_emprestimo;
            $status = $data->status;

            $success = emprestimoRepository::insertemprestimo(new emprestimo(null, $data_emprestimo, $status));
            echo json_encode(['success' => $success]);
        } else {
            http_response_code(405);
        }
    }

    public static function atualizaremprestimo() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));
            $id = $data->id;
            $status = $data->status;
            $data_emprestimo = $data->data_emprestimo;

            // Existindo um emprestimo!
            $emprestimoExistente = emprestimoRepository::getemprestimoById($id);
            if($emprestimoExistente) {
                //update das propriedades do emprestimo
                $emprestimoExistente->setStatus($status);
                $emprestimoExistente->setData($data_emprestimo);

                $success = emprestimoRepository::updateemprestimo($emprestimoExistente, $id);
                echo json_encode(['success' => $success]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'emprestimo não encontrado']);
            }
        } else {
            http_response_code(405);
        }        
    }

    public static function excluiremprestimo() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));
            $id = $data->id;
            $success = emprestimoRepository::deleteemprestimo($id);
            echo json_encode(['success' => $success]);
        } else {
            http_response_code(405);
        }       
    }
}
?>