<?php
// Configurações do banco de dados
$host = "localhost"; // Host do banco de dados
$usuario = "ayslan"; // Usuário do banco de dados
$senha = "E3jnECC6Y6e0/BK*"; // Senha do banco de dados
$banco = "ayslan"; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Se chegou até aqui, a conexão foi bem sucedida
echo "Conexão bem sucedida!";

// Não é necessário fechar a conexão aqui, pois isso será feito automaticamente ao final do script

?>
