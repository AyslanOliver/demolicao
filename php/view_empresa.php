<?php
// Conectar ao banco de dados
require_once 'conexao.php'; 
// Criar conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Query para selecionar todos os dados da tabela cad_empresa
$sql = "SELECT cnpj, razao_social, nome_fantasia, data_abertura, ddd_telefone_1, email, cep, logradouro, numero, bairro, municipio, uf FROM cad_empresa";
$result = $conn->query($sql);

// Verificar se há resultados e exibir na tabela HTML
if ($result->num_rows > 0) {
    // Exibir cabeçalho da tabela
    echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
            <thead>
                <tr>
                    <th>CNPJ</th>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>Data de Abertura</th>
                    <th>Número de Contato</th>
                    <th>E-mail</th>
                    <th>CEP</th>
                    <th>Logradouro</th>
                    <th>Número</th>
                    <th>Bairro</th>
                    <th>Município</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>";

    // Exibir os dados na tabela
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["cnpj"]."</td>
                <td>".$row["razao_social"]."</td>
                <td>".$row["nome_fantasia"]."</td>
                <td>".$row["data_abertura"]."</td>
                <td>".$row["ddd_telefone_1"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["cep"]."</td>
                <td>".$row["logradouro"]."</td>
                <td>".$row["numero"]."</td>
                <td>".$row["bairro"]."</td>
                <td>".$row["municipio"]."</td>
                <td>".$row["uf"]."</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "0 resultados";
}
// Fechar conexão
$conn->close();
?>
