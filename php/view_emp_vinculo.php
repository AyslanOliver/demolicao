<?php
// Arquivo de conexão com o banco de dados
require_once 'conexao.php';

// CNPJ a ser pesquisado
$cnpj = $_GET['cnpj'];

// Consulta SQL
$sql = "SELECT ID, razao_social, nome_fantasia FROM cad_empresa WHERE cnpj = ?";

// Preparar a declaração
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}

$stmt->bind_param("s", $cnpj);

// Executar a consulta
if (!$stmt->execute()) {
    die("Erro ao executar a consulta: " . $stmt->error);
}

// Vincular as variáveis de resultado
$stmt->bind_result($ID, $razao_social, $nome_fantasia);

// Exibir os resultados
if ($stmt->fetch()) {
    echo "ID: " . $ID . " - Razão Social: " . $razao_social . " - Nome Fantasia: " . $nome_fantasia;
} else {
    echo "Nenhum resultado encontrado para o CNPJ informado.";
}

// Fechar a declaração
$stmt->close();

// Fechar a conexão
$conn->close();
?>
