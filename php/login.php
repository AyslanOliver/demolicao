<?php
session_start();

// Verifica se os campos de nome e senha foram preenchidos
if(isset($_POST['email']) && isset($_POST['senha'])) {
    // Inclui o arquivo de conexão
    include '../php/conexao.php';
    
    // Evita SQL Injection
    $nome = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);
    
    // Consulta SQL para verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE email = '$nome' AND senha = '$senha'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Usuário autenticado com sucesso
        $_SESSION['conexao'] = $conn;
        
        echo "Login bem-sucedido!";
        // Redireciona para a página de dashboard
        header("Location: ../dashboard.html");
        exit();
    } else {
        echo "Nome ou senha incorretos!";
    }
}

// Fecha a conexão ao final
$conn->close();
?>
