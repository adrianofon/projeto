<?php
use PHPUnit\Framework\TestCase;

// Inclua os arquivos necessários
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../login.php';
require_once __DIR__ . '/../cadastrar.php';

class LoginTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        // Configuração inicial para cada teste
        $this->conn = new mysqli('localhost', 'root', '', 'loja_cupcakes');
        
        // Limpar tabela de usuários antes de cada teste
        $this->conn->query("TRUNCATE TABLE usuarios");
    }

    public function testCadastroUsuarioValido() {
        $_POST = [
            'nome' => 'Usuario Teste',
            'cpf' => '12345678901',
            'email' => 'teste@example.com',
            'senha' => 'senha123',
            'check-senha' => 'senha123'
        ];
        
        // Chama a função de cadastro
        ob_start();
        include __DIR__ . '/../cadastrar.php';
        $output = ob_get_clean();
        
        // Verifica se o redirecionamento ocorreu
        $this->assertStringContainsString('Location: login.html?sucesso=cadastro', implode('', headers_list()));
    }

    public function testLoginUsuarioValido() {
        // Primeiro cadastra um usuário
        $this->testCadastroUsuarioValido();
        
        // Agora testa o login
        $_POST = [
            'email' => 'teste@example.com',
            'senha' => 'senha123'
        ];
        
        // Inicia a sessão para teste
        session_start();
        
        // Chama a função de login
        ob_start();
        include __DIR__ . '/../login.php';
        $output = ob_get_clean();
        
        // Verifica se a sessão foi criada
        $this->assertArrayHasKey('usuario_id', $_SESSION);
        $this->assertArrayHasKey('usuario_nome', $_SESSION);
    }

    protected function tearDown(): void {
        // Limpeza após cada teste
        $this->conn->close();
        session_destroy();
    }
}