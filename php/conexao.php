<?php
// Configurações do banco de dados
$host = 'localhost'; // endereço do servidor MySQL
$usuario = 'Ayslan'; // nome de usuário do MySQL
$senha = 'xlJ.44UFez3f2aMK'; // senha do MySQL
$banco_de_dados = 'demolicao'; // nome do banco de dados a ser utilizado

// Conexão com o banco de dados
$conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}

// Não é necessário fechar a conexão aqui, pois isso será feito automaticamente ao final do script
?>