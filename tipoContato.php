<?php include 'conn/conexao.php'; ?>


<?php

//SE ENVIOU O FORMULÁRIO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST["descricao"];
    $sql = "INSERT INTO tipo_contato (descricao) VALUES ('$descricao')";

    $conn->query($sql);
    header("Location: formContato.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@100..700&family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@300;400&family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/tipoContato.css?v=<?= time(); ?>">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1 class="title">Adicionar tipo de contato</h1>
        <form class="form" method="POST" autocomplete="off">
            <input class="input" type="text" name="descricao" placeholder="Digite o tipo de contato">
            <button class="btn">Adicionar</button>
            <div class="pular">
                <a class="pular" href="formContato.php">Pular</a>
            </div>
        </form>
    </div>


    <?php $conn->close(); ?>
</body>

</html>