<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurações do banco de dados
$host = 'localhost';
$usuario = 'Ayslan';
$senha = 'xlJ.44UFez3f2aMK';
$banco_de_dados = 'demolicao';

// Conectar ao banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco_de_dados);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Receber o CNPJ enviado pela solicitação AJAX
$cnpj = $_POST['cnpj'];

// Consultar empresa no banco de dados
$sql = "SELECT id, razao_social, nome_fantasia FROM cad_empresa WHERE cnpj = '$cnpj'";
$result = $conn->query($sql);

if (!$result) {
    // Se houver um erro na consulta SQL, exibir o erro
    echo json_encode(array('success' => false, 'error' => 'Erro na consulta: ' . $conn->error));
    exit;
}

if ($result->num_rows > 0) {
    // Empresa encontrada, enviar detalhes como JSON
    $row = $result->fetch_assoc();
    echo json_encode(array('success' => true, 'id' => $row['id'], 'razao_social' => $row['razao_social'], 'nome_fantasia' => $row['nome_fantasia']));
} else {
    // Empresa não encontrada
    echo json_encode(array('success' => false, 'error' => 'Empresa não encontrada'));
}

// Fechar conexão com o banco de dados
$conn->close();
?>
