<?php
// Inclua o arquivo de conexão
require_once('conexao.php');

// Inicialize a sessão
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o email e a senha foram fornecidos
    if (!empty($_POST["email"]) && !empty($_POST["senha"])) {
        // Limpa os dados de entrada
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        try {
            // Prepara e executa a consulta usando prepared statements
            $stmt = $conn->prepare("SELECT * FROM user  WHERE email = :email AND senha = :senha");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            // Verifica se foi retornado algum registro
            if ($stmt->rowCount() > 0) {
                // O login foi bem-sucedido, redireciona para a página inicial
                header("Location: ../dashboard.html");
                exit();
            } else {
                // Login inválido, exibe uma mensagem de erro
                echo "Email ou senha inválidos.";
            }
        } catch(PDOException $e) {
            // Em caso de erro na consulta, exibe uma mensagem de erro
            echo "Erro ao fazer login: " . $e->getMessage();
        }
    } else {
        // Email ou senha não foram fornecidos, exibe uma mensagem de erro
        echo "Por favor, preencha o email e a senha.";
    }
}
?>
