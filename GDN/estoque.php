<?php
include('config.php');

// Seleção dos dados no Banco
$sql = "SELECT * FROM estoque";
$result = $conn->query($sql);
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Estoque de Clientes</title>
</head>

<body>
    

    <div class="cadedit">
        <form action="insert.php" method="POST">
            <h1>Cadastro/Edição de Itens</h1>
            <div class="box">
                <input type="text" name="produto" required>
                <label for="produto">Nome do Produto</label>
            </div>
            <div class="box">
                <input type="number" name="quant_dis" required>
                <label for="quant_dis">Quantidade Disponivel do Produto</label>
            </div>
            <div class="box">
                <input type="number" name="quant_min" required>
                <label for="quant_min">Quantidade Minima do Produto</label>
            </div>
            <div class="box">
                <input type="text" name="imagem_produto" required>
                <label for="imagem_produto">Imagem do Produto</label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
    <h1>Almoxarifado</h1>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do Produto</th>
                <th scope="col">Quantidade Disponivel</th>
                <th scope="col">Quantidade Minima</th>
                <th scope="col">Imagem do Produto</th>
                <th scope="col">Quantidade Total</th>
                <th scope="col">Editar</th>
                <th scope="col">Enviar Pedidos</th>
                <th scope="col">Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($user_data = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$user_data['id']."</td>";
                echo "<td>".$user_data['nome_produto']."</td>";
                echo "<td>".$user_data['quant_dis']."</td>";
                echo "<td>".$user_data['quant_min']."</td>";
                echo "<td>".$user_data['imagem_produto']."</td>";
                echo "<td>".$user_data['quant_total']."</td>";
                echo "<td>
                    <a class='btn btn-sm btn-primary' href='edit.php?id=".$user_data['id']."'>
                        <i class='material-icons'>edit</i>
                    </a>
                </td>";
                echo "<td>
                    <a class='btn btn-sm btn-primary' href='pedidos.php?id=".$user_data['id']."'>
                        <i class='material-icons'>archive</i>
                    </a>
                </td>";
                echo "<td>
                    <a class='btn btn-sm btn-primary' href='delete.php?id=".$user_data['id']."'>
                        <i class='material-icons'>delete</i>
                    </a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
