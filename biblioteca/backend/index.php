<?php
require_once 'controller/EmprestimoController.php';
require_once 'controller/LivroController.php';

$entity = $_GET['entity'];
$action = $_GET['action'];

switch($entity) {
    case 'emprestimo':        
        emprestimoController::handleRequest($action);
        break;
    case 'livro':
        livroController::handleRequest($action);
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Entidade inválida!']);
        break;
}

?>