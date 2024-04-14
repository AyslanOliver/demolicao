<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Consulta SQL para recuperar as empresas
$sql = "SELECT id, nome FROM Empresa";
$result = $conn->query($sql);

// Inicializa a variável de opções
$options = "";

// Loop para gerar as opções da lista suspensa
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>";
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
