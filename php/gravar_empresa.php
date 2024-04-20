<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    require_once 'conexao.php';

    // Verificar se já existe uma empresa com o mesmo CNPJ
    $sql_verificar = "SELECT id FROM cad_empresa WHERE cnpj = ?";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bindParam(1, $_POST['cnpj']);
    $stmt_verificar->execute();
    $resultado = $stmt_verificar->fetch(PDO::FETCH_ASSOC);

    // Se já existir uma empresa com o mesmo CNPJ, exibir mensagem de erro
    if ($resultado) {
        echo '<script>alert("Já existe uma empresa cadastrada com esse CNPJ!"); window.location.href = "../cad_empresa.html";</script>';
        exit;
    }

    // Prepara e executa a declaração de inserção
    $sql = "INSERT INTO cad_empresa (cnpj, razao_social, nome_fantasia, data_abertura, ddd_telefone_1, email, cep, logradouro, numero, bairro, municipio, uf) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação teve êxito
    if (!$stmt) {
        die("Erro na preparação da declaração: " . $conn->errorInfo()[2]);
    }

    // Vincula parâmetros à declaração
    $stmt->bindParam(1, $_POST['cnpj']);
    $stmt->bindParam(2, $_POST['razao_social']);
    $stmt->bindParam(3, $_POST['nome_fantasia']);
    $stmt->bindParam(4, $_POST['data_abertura']);
    $stmt->bindParam(5, $_POST['ddd_telefone_1']);
    $stmt->bindParam(6, $_POST['email']);
    $stmt->bindParam(7, $_POST['cep']);
    $stmt->bindParam(8, $_POST['logradouro']);
    $stmt->bindParam(9, $_POST['numero']);
    $stmt->bindParam(10, $_POST['bairro']);
    $stmt->bindParam(11, $_POST['municipio']);
    $stmt->bindParam(12, $_POST['uf']);

    // Executa a declaração
    if ($stmt->execute()) {
        // Popup de sucesso e redirecionamento
        echo '<script>alert("Dados gravados com sucesso!"); window.location.href = "../dashboard.html";</script>';
    } else {
        // Popup de erro e redirecionamento
        echo '<script>alert("Erro ao gravar dados: ' . $stmt->errorInfo()[2] . '"); window.location.href = "../cad_empresa";</script>';
    }

    // Fecha a declaração
    $stmt->closeCursor();

    // Fecha a conexão
    $conn = null;
} else {
    // Se o formulário não foi submetido corretamente, redireciona para a página anterior ou exibe uma mensagem de erro
    echo "Ocorreu um erro ao processar o formulário.";
}
?>
