-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS loja_cupcakes;
USE loja_cupcakes;

-- Tabela de usuários (para login/cadastro)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de produtos (para o cardápio)
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(10) UNIQUE NOT NULL,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255)
);

-- Tabela de mensagens de contato
CREATE TABLE IF NOT EXISTS mensagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserção de produtos iniciais
INSERT INTO produtos (codigo, nome, descricao, preco, imagem) VALUES
('COD001', 'Cupcake de Chocolate', 'Delicioso cupcake de chocolate com cobertura de ganache', 5.00, 'cupcake.jpg'),
('COD002', 'Cupcake de Morango', 'Cupcake de morango com recheio de geleia de morango', 5.00, 'cupcake2.jpg'),
('COD003', 'Cupcake de Baunilha', 'Cupcake de baunilha com cobertura de chantilly', 5.00, 'cupcake3.jpg');