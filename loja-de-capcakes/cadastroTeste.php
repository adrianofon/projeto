<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../cadastrar.php';

class CadastroTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        $this->conn = new mysqli('localhost', 'root', '', 'loja_cupcakes');
        $this->conn->query("TRUNCATE TABLE usuarios");
    }

    public function testCadastroValido() {
        $_POST = [
            'nome' => 'Maria Silva',
            'cpf' => '12345678901',
            'email' => 'maria@teste.com',
            'senha' => 'Senha@123',
            'check-senha' => 'Senha@123'
        ];

        ob_start();
        include __DIR__ . '/../cadastrar.php';
        $output = ob_get_clean();

        // Verifica se o usuário foi criado no banco
        $result = $this->conn->query("SELECT * FROM usuarios WHERE email = 'maria@teste.com'");
        $this->assertEquals(1, $result->num_rows);
    }

    public function testCadastroSenhasDiferentes() {
        $_POST = [
            'nome' => 'João Santos',
            'cpf' => '98765432109',
            'email' => 'joao@teste.com',
            'senha' => 'Senha@123',
            'check-senha' => 'SenhaDiferente'
        ];

        ob_start();
        include __DIR__ . '/../cadastrar.php';
        $output = ob_get_clean();

        // Verifica se NÃO criou o usuário
        $result = $this->conn->query("SELECT * FROM usuarios WHERE email = 'joao@teste.com'");
        $this->assertEquals(0, $result->num_rows);
    }

    protected function tearDown(): void {
        $this->conn->close();
    }
}