<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../email.php';

class ContatoTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        $this->conn = new mysqli('localhost', 'root', '', 'loja_cupcakes');
        $this->conn->query("TRUNCATE TABLE mensagens");
    }

    public function testEnvioFormularioValido() {
        $_POST = [
            'name' => 'Carlos Ferreira',
            'email' => 'carlos@teste.com',
            'message' => 'Gostaria de saber sobre sabores especiais'
        ];

        ob_start();
        include __DIR__ . '/../email.php';
        $output = ob_get_clean();

        // Verifica se a mensagem foi salva no banco
        $result = $this->conn->query("SELECT * FROM mensagens WHERE email = 'carlos@teste.com'");
        $this->assertEquals(1, $result->num_rows);
    }

    public function testEnvioFormularioInvalido() {
        $_POST = [
            'name' => '',
            'email' => 'email-invalido',
            'message' => ''
        ];

        ob_start();
        include __DIR__ . '/../email.php';
        $output = ob_get_clean();

        // Verifica se NÃO salvou no banco
        $result = $this->conn->query("SELECT * FROM mensagens");
        $this->assertEquals(0, $result->num_rows);
    }

    protected function tearDown(): void {
        $this->conn->close();
    }
}