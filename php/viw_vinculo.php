<?php
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
$sql = "SELECT id, nome, cpf, cnpj, razao_social, nome_fantasia, celular, estado FROM clienteempresa ";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Início da tabela HTML
   

    // Saída de dados de cada linha
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["cpf"] . "</td>";
        echo "<td>" . $row["cnpj"] . "</td>";
        echo "<td>" . $row["razao_social"] . "</td>";
        echo "<td>" . $row["nome_fantasia"] . "</td>";
        echo "<td>" . $row["celular"] . "</td>";
        echo "<td>" . $row["estado"] . "</td>";
        echo "</tr>";
    }

    // Fim da tabela HTML
    echo "</tbody>";
    echo "</table>";
} else {
    echo "0 resultados";
}

// Fecha a conexão
$conn->close();
?>
