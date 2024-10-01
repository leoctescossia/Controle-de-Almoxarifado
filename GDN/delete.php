<?php
include('config.php');

// Verifica se foi enviado o ID do produto
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara e executa a exclusão do registro
    $stmt = $conn->prepare("DELETE FROM estoque WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro ao excluir registro: " . $stmt->error;
    }

    $stmt->close();
    header("Location: estoque.php");
    exit();
} else {
    echo "ID do produto não especificado";
}
?>
