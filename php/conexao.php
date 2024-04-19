<?php
// Configurações do banco de dados
$host = 'localhost'; // endereço do servidor MySQL
$usuario = 'Ayslan'; // nome de usuário do MySQL
$senha = 'xlJ.44UFez3f2aMK'; // senha do MySQL
$banco_de_dados = 'demolicao'; // nome do banco de dados a ser utilizado

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$host;dbname=$banco_de_dados", $usuario, $senha);
    
    // Configura o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Em caso de erro na conexão, exibe uma mensagem de erro
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
