<?php
// PHP script para exibir a tabela de empresas

// Dados de conexão com o banco de dados
$host = 'localhost'; // endereço do servidor MySQL
$usuario = 'Ayslan'; // nome de usuário do MySQL
$senha = 'xlJ.44UFez3f2aMK'; // senha do MySQL
$banco_de_dados = 'demolicao'; // nome do banco de dados a ser utilizado

// Cria a conexão
$conn = new mysqli($host, $usuario, $senha, $banco_de_dados);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta SQL para obter os dados das empresas
$sql = "SELECT cnpj, razao_social, nome_fantasia, data_abertura, telefone, municipio FROM cad_empresa";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Início da tabela
    echo "<tbody>";

    // Saída de dados de cada linha
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["cnpj"] . "</td>";
        echo "<td>" . $row["razao_social"] . "</td>";
        echo "<td>" . $row["nome_fantasia"] . "</td>";
        echo "<td>" . $row["data_abertura"] . "</td>";
        echo "<td>" . $row["telefone"] . "</td>";
        echo "<td>" . $row["municipio"] . "</td>";
        echo "</tr>";
    }

    // Fim da tabela
    echo "</tbody>";
} else {
    echo "0 resultados";
}

// Verifica o resultado retornado pelo banco de dados
var_dump($result);

// Fecha a conexão
$conn->close();
?>
