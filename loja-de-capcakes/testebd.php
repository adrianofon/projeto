<?php
require 'conexao.php';

$result = $conn->query("SHOW TABLES");
echo "Tabelas no banco de dados:<br>";
while ($row = $result->fetch_array()) {
    echo "- " . $row[0] . "<br>";
}
$conn->close();