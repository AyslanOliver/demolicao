<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    require_once 'conexao.php'; // Supondo que seu arquivo de conexão se chama 'conexao.php' e está na mesma pasta

    // Verificar se já existe um cliente com o mesmo CPF
    $sql_verificar = "SELECT id FROM cad_cliente WHERE cpf = ?";
    $stmt_verificar = $conexao->prepare($sql_verificar);
    $stmt_verificar->bind_param("s", $_POST['cpf']);
    $stmt_verificar->execute();
    $resultado = $stmt_verificar->get_result();

    // Se já existir um cliente com o mesmo CPF, exibir mensagem de erro
    if ($resultado->num_rows > 0) {
        echo '<script>alert("Já existe um cliente cadastrado com esse CPF!"); window.location.href = "../cad_cliente.html";</script>';
        exit; // Termina a execução do script para evitar a inserção de dados duplicados
    }

    // Prepara e executa a declaração de inserção
    $sql = "INSERT INTO cad_cliente (nome, nascimento, genero, cpf, rg, celular, email, cep, endereco, numero, bairro, cidade, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração SQL
    $stmt = $conexao->prepare($sql);

    // Verifica se a preparação teve êxito
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $conexao->error);
    }

    // Vincula parâmetros à declaração
    $stmt->bind_param(
        "sssssssssssss",
        $_POST['nome'],
        $_POST['nascimento'],
        $_POST['genero'],
        $_POST['cpf'],
        $_POST['rg'],
        $_POST['celular'],
        $_POST['email'],
        
   
    );

    // Executa a declaração
    if ($stmt->execute()) {
        // Popup de sucesso e redirecionamento
        echo '<script>alert("Dados gravados com sucesso!"); window.location.href = "../index.html";</script>';
    } else {
        // Popup de erro e redirecionamento
        echo '<script>alert("Erro ao gravar dados: ' . $stmt->error . '"); window.location.href = "index.html";</script>';
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
