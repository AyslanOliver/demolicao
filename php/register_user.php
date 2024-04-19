<?php
// Inclua o arquivo de conexão
include 'conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os valores dos campos do formulário
    $nome = $_POST['nome'] ?? '';
    $sobrenome = $_POST['sobrenome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $repetir_senha = $_POST['repetir_senha'] ?? '';

    // Faça aqui as validações necessárias
    // Por exemplo, verificar se os campos obrigatórios foram preenchidos

    // Exibir os valores submetidos
    echo "Nome: " . $nome . "<br>";
    echo "Sobrenome: " . $sobrenome . "<br>";
    echo "E-mail: " . $email . "<br>";
    echo "Senha: " . $senha . "<br>";
    echo "Repetir Senha: " . $repetir_senha . "<br>";

    // Exemplo de inserção no banco de dados
    // Substitua os placeholders pelos valores dos campos do formulário
    $sql = "INSERT INTO sua_tabela (nome, sobrenome, email, senha) VALUES ('$nome', '$sobrenome', '$email', '$senha')";

    // Executa a query
    if (mysqli_query($conexao, $sql)) {
        echo "Registro inserido com sucesso.";
    } else {
        echo "Erro ao inserir registro: " . mysqli_error($conexao);
    }

    // Fecha a conexão
    mysqli_close($conexao);
}
?>
