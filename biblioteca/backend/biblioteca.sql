create database biblioteca;

use biblioteca;

CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(15)
);

-- Criação da tabela 'livro'
CREATE TABLE livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    ano_publicacao INT,
    isbn VARCHAR(20) UNIQUE NOT NULL
);

-- Criação da tabela 'emprestimo'
CREATE TABLE emprestimo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_livro INT NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE,
    status ENUM('emprestado', 'devolvido') NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id),
    FOREIGN KEY (id_livro) REFERENCES livro(id)
);

-- Inserindo clientes
INSERT INTO cliente (nome, email, telefone) VALUES
('João Silva', 'joao.silva@example.com', '123456789'),
('Maria Oliveira', 'maria.oliveira@example.com', '987654321'),
('Carlos Souza', 'carlos.souza@example.com', '555444333');

-- Inserindo livros
INSERT INTO livro (titulo, autor, ano_publicacao, isbn) VALUES
('O Senhor dos Anéis', 'J.R.R. Tolkien', 1954, '978-3-16-148410-0'),
('1984', 'George Orwell', 1949, '978-0-452-28423-4'),
('A Revolução dos Bichos', 'George Orwell', 1945, '978-0-452-28425-8');

-- Inserindo empréstimos
INSERT INTO emprestimo (id_cliente, id_livro, data_emprestimo, data_devolucao, status) VALUES
(1, 1, '2024-05-01', NULL, 'emprestado'),
(2, 2, '2024-05-05', '2024-05-15', 'devolvido'),
(3, 3, '2024-05-10', NULL, 'emprestado');