<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Inclui o arquivo de conexão com o banco de dados
    require_once "../site/php/conexao.php";
    
    // Prepare e execute a declaração de inserção
    $sql = "INSERT INTO tabela_clientes (nome, nascimento, genero, cpf, rg, celular, email, cep)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepara a declaração SQL
    $stmt = $conexao->prepare($sql);
    
    // Verifica se a preparação teve êxito
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $conexao->error);
    }
    
    // Vincula parâmetros à declaração
    $stmt->bind_param(
        "ssssssss",
        $_POST['nome'],
        $_POST['nascimento'],
        $_POST['genero'],
        $_POST['cpf'],
        $_POST['rg'],
        $_POST['celular'],
        $_POST['email'],
        $_POST['cep']
    );
    
    // Executa a declaração
    if ($stmt->execute()) {
        echo "Dados gravados com sucesso!";
    } else {
        echo "Erro ao gravar dados: " . $stmt->error;
    }
    
    // Fecha a declaração e a conexão
    $stmt->close();
    $conexao->close();
} else {
    // Se o formulário não foi submetido corretamente, redireciona para a página anterior ou exibe uma mensagem de erro
    echo "Ocorreu um erro ao processar o formulário.";
}
?>
