<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estoque";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Ação ao submeter o formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    // Adicionar item ao banco de dados
    $sql = "INSERT INTO produtos (nome, quantidade, preco, descricao) VALUES ('$nome', '$quantidade', '$preco', '$descricao')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo produto adicionado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Listar produtos na tabela
$sql = "SELECT id, nome, quantidade, preco, descricao FROM produtos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['quantidade']}</td>
                <td>{$row['preco']}</td>
                <td>{$row['descricao']}</td>
                <td>
                    <button>Editar</button>
                    <button>Excluir</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>Nenhum produto encontrado</td></tr>";
}

$conn->close();
?>
