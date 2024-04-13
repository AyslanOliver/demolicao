<?php
// Credenciais de conexão
$host = "localhost"; // Host do Banco de Dados
$usuario = "Ayslan'"; // Nome de Usuário do Banco de Dados
$senha = "THPHiBuZy4t4]O9z"; // Senha do Banco de Dados
$banco_de_dados = "Ayslan'"; // Nome do Banco de Dados

// Criando a conexão
$conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

echo "Conexão bem-sucedida";

// Agora você pode executar consultas SQL, por exemplo:
// $sql = "SELECT * FROM sua_tabela";
// $resultado = $conexao->query($sql);

// Lembre-se de fechar a conexão quando terminar
$conexao->close();

