<?php
require_once "php/conexao.php";

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; // Lembre-se de fazer o hash da senha antes de armazenar no banco de dados

    // Query SQL para inserir dados
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    // Executa a query SQL
    if ($conn->query($sql) === TRUE) {
        // Registro inserido com sucesso
        // Exibir pop-up com a mensagem
        echo '<script>alert("Cadastro realizado com sucesso!");</script>';
        // Redirecionar para index.html após exibir o pop-up
        echo '<script>window.location = "index.html";</script>';
        exit(); // Termina o script após o redirecionamento
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }
} else {
    // Se não for uma requisição POST, redireciona para a página de cadastro
    header("Location: index.html");
    exit(); // Termina o script após o redirecionamento
}

// Fecha a conexão ao final
$conn->close();
?>
