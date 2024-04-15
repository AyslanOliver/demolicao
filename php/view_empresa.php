<?php
// Dados de conexão com o banco de dados
$host = 'localhost'; // endereço do servidor MySQL
$usuario = 'Ayslan'; // nome de usuário do MySQL
$senha = 'xlJ.44UFez3f2aMK'; // senha do MySQL
$banco_de_dados = 'demolicao'; // nome do banco de dados a ser utilizado


// Criar conexão
$conn = new mysqli($host, $usuario, $senha, $banco_de_dados);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar se há erros de conexão
if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Query para selecionar todos os dados da tabela cad_empresa
$sql = "SELECT cnpj, razao_social, nome_fantasia, data_abertura, ddd_telefone_1, email, cep, logradouro, numero, bairro, municipio, uf FROM cad_empresa";

// Verificar se a conexão está estabelecida antes de executar a consulta
if ($conn) {
    // Executar a consulta
    $result = $conn->query($sql);

    // Verificar se a consulta foi bem-sucedida
    if ($result) {
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
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["cnpj"] . "</td>
                    <td>" . $row["razao_social"] . "</td>
                    <td>" . $row["nome_fantasia"] . "</td>
                    <td>" . $row["data_abertura"] . "</td>
                    <td>" . $row["ddd_telefone_1"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["cep"] . "</td>
                    <td>" . $row["logradouro"] . "</td>
                    <td>" . $row["numero"] . "</td>
                    <td>" . $row["bairro"] . "</td>
                    <td>" . $row["municipio"] . "</td>
                    <td>" . $row["uf"] . "</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Erro ao executar consulta: " . $conn->error;
    }
} else {
    echo "Não foi possível conectar ao banco de dados.";
}

// Fechar conexão
if ($conn) {
    $conn->close();
}
?>
