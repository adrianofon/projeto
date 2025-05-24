<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $cpf, $email, $senha);

    if ($stmt->execute()) {
        header("Location: login.html?sucesso=cadastro");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
}
?>