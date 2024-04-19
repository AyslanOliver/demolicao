<?php
// Incluir o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consultar o banco de dados para encontrar o usuário com o e-mail fornecido
    $sql = "SELECT * FROM Users WHERE Email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se o usuário existe e se a senha está correta
    if ($user && password_verify($senha, $user['PasswordHash'])) {
        // Login bem-sucedido
        echo "Login bem-sucedido! Bem-vindo, " . $user['Email'];
        // Aqui você pode redirecionar o usuário para a página inicial, por exemplo
         header('Location: ../dashboard.html');
    } else {
        // Login falhou
        echo "Credenciais inválidas. Por favor, tente novamente.";
    }
}
?>
