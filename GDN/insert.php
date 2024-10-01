<?php
include('config.php');

// Inserção dos dados no Banco
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_produto = $_POST['produto'];
    $quant_dis = $_POST['quant_dis'];
    $quant_min = $_POST['quant_min'];
    $imagem_produto = $_POST['imagem_produto'];

    $stmt = $conn->prepare("INSERT INTO estoque (nome_produto, quant_dis, quant_min, imagem_produto) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siis", $nome_produto, $quant_dis, $quant_min, $imagem_produto);

    if ($stmt->execute()) {
        echo "Novo registro criado com sucesso";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
    header("Location: estoque.php");
    exit();
}
?>
