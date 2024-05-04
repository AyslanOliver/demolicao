<?php
// Inclui o arquivo de conexão
require_once('conexao.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if (!empty($_POST["nome"]) && !empty($_POST["sobrenome"]) && !empty($_POST["email"]) && !empty($_POST["senha"]) && !empty($_POST["repetirsenha"])) {
        
        // Limpar os dados de entrada
        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $repetir_senha = $_POST["repetirsenha"];

        // Verifica se as senhas coincidem
        if ($senha !== $repetir_senha) {
            echo "As senhas não coincidem.";
            exit();
        }

        try {
            // Preparar e executar a consulta usando prepared statements
            $stmt = $conn->prepare("INSERT INTO user (nome, sobrenome, email, senha, repetirsenha) VALUES (:nome, :sobrenome, :email, :senha, :repetirsenha)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':repetirsenha', $repetir_senha);
            $stmt->execute();
            
            // Verifica se o registro foi inserido com sucesso
            if ($stmt->rowCount() > 0) {
                // Define uma variável de sessão para indicar que o cadastro foi bem-sucedido
                $_SESSION['registro_sucesso'] = true;
                // Redireciona para a página index.html
                header("Location: ../register2.html");
                exit();
            } else {
                echo "Erro ao inserir o registro no banco de dados.";
            }
        } catch(PDOException $e) {
            // Em caso de erro na consulta, exibe uma mensagem de erro
            echo "Erro ao registrar: " . $e->getMessage();
        }
    } else {
        echo "Todos os campos devem ser preenchidos.";
    }
}
?>
