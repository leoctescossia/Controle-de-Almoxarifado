<?php
include('config.php');

// Verifica se foi enviado o ID do produto
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Seleciona os dados do produto para exibição no formulário
    $stmt = $conn->prepare("SELECT * FROM estoque WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();
    $stmt->close();
}

// Atualiza os dados no banco
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome_produto = $_POST['produto'];
    $quant_dis = $_POST['quant_dis'];
    $quant_min = $_POST['quant_min'];
    $imagem_produto = $_POST['imagem_produto'];

    $stmt = $conn->prepare("UPDATE estoque SET nome_produto = ?, quant_dis = ?, quant_min = ?, imagem_produto = ? WHERE id = ?");
    $stmt->bind_param("siisi", $nome_produto, $quant_dis, $quant_min, $imagem_produto, $id);

    if ($stmt->execute()) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
    header("Location: estoque.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Editar Produto</title>
</head>
<body>
<div class="cadedit">
    <form action="edit.php" method="POST">
        <h1>Editar Produto</h1>
        <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
        <div class="box">
            <input type="text" name="produto" value="<?php echo htmlspecialchars($user_data['nome_produto']); ?>" required>
            <label for="produto">Nome do Produto</label>
        </div>
        <div class="box">
            <input type="number" name="quant_dis" value="<?php echo htmlspecialchars($user_data['quant_dis']); ?>" required>
            <label for="quant_dis">Quantidade Disponivel do Produto</label>
        </div>
        <div class="box">
            <input type="number" name="quant_min" value="<?php echo htmlspecialchars($user_data['quant_min']); ?>" required>
            <label for="quant_min">Quantidade Minima do Produto</label>
        </div>
        <div class="box">
            <input type="text" name="imagem_produto" value="<?php echo htmlspecialchars($user_data['imagem_produto']); ?>" required>
            <label for="imagem_produto">Imagem do Produto</label>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
</body>
</html>
