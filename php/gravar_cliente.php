<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    require_once 'conexao.php';

    // Verificar se já existe um cliente com o mesmo CPF
    $sql_verificar = "SELECT id FROM cad_cliente WHERE cpf = ?";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bindParam(1, $_POST['cpf']);
    $stmt_verificar->execute();
    $resultado = $stmt_verificar->fetch(PDO::FETCH_ASSOC);

    // Se já existir um cliente com o mesmo CPF, exibir mensagem de erro
    if ($resultado) {
        echo '<script>alert("Já existe um cliente cadastrado com esse CPF!"); window.location.href = "../cad_cliente.html";</script>';
        exit; // Termina a execução do script para evitar a inserção de dados duplicados
    }

    // Prepara e executa a declaração de inserção
    $sql = "INSERT INTO cad_cliente (nome, nascimento, genero, cpf, rg, celular, email, cep, endereco, numero, bairro, cidade, estado, id, cnpj, razao_social, nome_fantasia) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação teve êxito
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $conn->errorInfo());
    }

    // Vincula parâmetros à declaração
    $stmt->bindParam(1, $_POST['nome']);
    $stmt->bindParam(2, $_POST['nascimento']);
    $stmt->bindParam(3, $_POST['genero']);
    $stmt->bindParam(4, $_POST['cpf']);
    $stmt->bindParam(5, $_POST['rg']);
    $stmt->bindParam(6, $_POST['ddd_telefone_1']); // Corrigindo para ddd_telefone_1
    $stmt->bindParam(7, $_POST['email']);
    $stmt->bindParam(8, $_POST['cep']);
    $stmt->bindParam(9, $_POST['logradouro']);
    $stmt->bindParam(10, $_POST['numero']);
    $stmt->bindParam(11, $_POST['bairro']);
    $stmt->bindParam(12, $_POST['municipio']);
    $stmt->bindParam(13, $_POST['uf']);
    $stmt->bindParam(14, $_POST['id']);
    $stmt->bindParam(15, $_POST['cnpj']);
    $stmt->bindParam(16, $_POST['razao_social']);
    $stmt->bindParam(17, $_POST['nome_fantasia']);

    // Executa a declaração
    if ($stmt->execute()) {
        // Popup de sucesso e redirecionamento
        echo '<script>alert("Dados gravados com sucesso!"); window.location.href = "../dashboard.html";</script>';
    } else {
        // Popup de erro e redirecionamento
        echo '<script>alert("Erro ao gravar dados: ' . $stmt->errorInfo() . '"); window.location.href = "cad_cliente.html";</script>';
    }

    // Fecha a declaração
    $stmt->closeCursor();

    // Fecha a conexão
    $conn = null;
} else {
    // Se o formulário não foi submetido corretamente, redireciona para a página anterior ou exibe uma mensagem de erro
    echo "Ocorreu um erro ao processar o formulário.";
}
?>
