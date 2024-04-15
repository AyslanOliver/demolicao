<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir o arquivo de conexão com o banco de dados
include 'conexao.php';

$options = '';

// Consulta SQL para buscar os nomes das empresas
$sql = "SELECT razao_social FROM  cad_empresa";
$result = $conn->query($sql);

// Preenche as opções do menu suspenso com os nomes das empresas
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row["razao_social"] . '">' . $row["razao_social"] . '</option>';
    }
} else {
    $options = '<option value="">Nenhuma empresa encontrada</option>';
}

// Fechar a conexão com o banco de dados
$conn->close();

// Retornar as opções do menu suspenso
echo $options;
?>
