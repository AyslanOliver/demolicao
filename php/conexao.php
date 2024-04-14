<?php
// Configurações do banco de dados
$host = 'localhost'; // endereço do servidor MySQL
$usuario = 'seu_usuario'; // nome de usuário do MySQL
$senha = 'sua_senha'; // senha do MySQL
$banco_de_dados = 'nome_do_banco_de_dados'; // nome do banco de dados a ser utilizado

// Conexão com o banco de dados
$conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}

// Fecha a conexão com o banco de dados quando não for mais necessário
$conexao->close();
?>


