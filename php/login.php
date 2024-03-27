<?php
// Incluir o arquivo de conexão com o banco de dados
require_once '../php/conexao.php';

// Recuperar dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta SQL para buscar o usuário
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Usuário encontrado, verificar senha
    $user = $result->fetch_assoc();
    if (password_verify($senha, $user['senha'])) {
        // Senha correta, iniciar sessão
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['email'] = $email;
        echo "Login bem-sucedido!";
        // Redirecionar para a página inicial ou outra página
        header("Location: dashboard.html");
        exit;
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}

$stmt->close();
?>