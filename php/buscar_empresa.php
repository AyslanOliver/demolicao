<?php
// Incluir arquivo de conexão com o banco de dados
include 'conexao.php';

// Consulta SQL para obter os nomes das empresas
$sql = "SELECT nome_empresa FROM empresas";
$result = $conn->query($sql);

// Inicializar um array para armazenar os nomes das empresas
$empresas = array();

// Preencher o array com os nomes das empresas
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $empresas[] = $row["nome_empresa"];
    }
}

// Enviar os nomes das empresas como resposta em formato JSON
echo json_encode($empresas);

// Fechar conexão com o banco de dados
$conn->close();
?>
