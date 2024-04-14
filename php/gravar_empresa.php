<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    require_once 'conexao.php'; // Supondo que seu arquivo de conexão se chama 'conexao.php' e está na mesma pasta

    // Verificar se já existe uma empresa com o mesmo CNPJ
    $sql_verificar = "SELECT id FROM cad_empresa WHERE cnpj = ?";
    $stmt_verificar = $conexao->prepare($sql_verificar);
    $stmt_verificar->bind_param("s", $_POST['cnpj']);
    $stmt_verificar->execute();
    $resultado = $stmt_verificar->get_result();

    // Se já existir uma empresa com o mesmo CNPJ, exibir mensagem de erro
    if ($resultado->num_rows > 0) {
        echo '<script>alert("Já existe uma empresa cadastrada com esse CNPJ!"); window.location.href = "index.html";</script>';
        exit; // Termina a execução do script para evitar a inserção de dados duplicados
    }

    // Prepara e executa a declaração de inserção
    $sql = "INSERT INTO cad_empresa (cnpj, razao_social, nome_fantasia, data_abertura, ddd_telefone_1, email, cep, logradouro, numero, bairro, municipio, uf) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração SQL
    $stmt = $conexao->prepare($sql);

    // Verifica se a preparação teve êxito
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $conexao->error);
    }

    // Vincula parâmetros à declaração
    $stmt->bind_param(
        "ssssssssssss",
        $_POST['cnpj'],
        $_POST['razao_social'],
        $_POST['nome_fantasia'],
        $_POST['data_abertura'],
        $_POST['ddd_telefone_1'],
        $_POST['email'],
        $_POST['cep'],
        $_POST['logradouro'],
        $_POST['numero'],
        $_POST['bairro'],
        $_POST['municipio'],
        $_POST['uf']
    );

    // Executa a declaração
    if ($stmt->execute()) {
        // Popup de sucesso e redirecionamento
        echo '<script>alert("Dados gravados com sucesso!"); window.location.href = "../index.html";</script>';
    } else {
        // Popup de erro e redirecionamento
        echo '<script>alert("Erro ao gravar dados: ' . $stmt->error . '"); window.location.href = "../cad_empresa";</script>';
    }

    // Fecha a declaração
    $stmt->close();

    // Fecha a conexão
    $conexao->close();
} else {
    // Se o formulário não foi submetido corretamente, redireciona para a página anterior ou exibe uma mensagem de erro
    echo "Ocorreu um erro ao processar o formulário.";
}
?>
