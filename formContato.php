<?php include 'conn/conexao.php'; ?>

<?php

//SE ENVIOU O FORMULÁRIO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $empresa = $_POST["empresa"];
    $observacao = $_POST["observacao"];

    //UPDATE
    if (isset($_POST["id_contato"])) {
        $id_contato = $_POST["id_contato"];
        $sql = "UPDATE contatos SET nome='$nome', telefone='$telefone', email='$email', empresa='$empresa', observacao='$observacao' WHERE id_contato=$id_contato";
    } else {
        //CREATE
        $sql = "INSERT INTO contatos (nome, telefone, email, empresa, observacao) VALUES ('$nome', '$telefone', '$email', '$empresa', '$observacao')";
    }
    $conn->query($sql);
    header("Location: index.php");
    exit();
}



//EDIT
$editar_contato = null;
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $res = $conn->query("SELECT * FROM contatos WHERE id_contato=$id");
    if ($res->num_rows > 0) {
        $editar_contato = $res->fetch_assoc(); //fetch_assoc() retorna um array associativo
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/formStyle.css?v=<?= time(); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@100..700&family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@300;400&family=Staatliches&display=swap" rel="stylesheet">

    <title>
        <?php
        if ($editar_contato) {
            echo "Editar contato";
        } else {
            echo "Adicionar contato";
        }
        ?>
    </title>
</head>

<body>
    <div class="container">
        <div class="header">
            <a class="back" href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                </svg>
            </a>
            <h1 class="title">
                <?php
                if ($editar_contato) {
                    echo "Editar contato";
                } else {
                    echo "Adicionar contato";
                }
                ?>
            </h1>


        </div>
        <div class="perfil_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
            </svg>
        </div>

        <form class="form" method="POST" autocomplete="off">
            <div class="require_info">
                <div class="require_input">
                    <label for=nome>Nome*</label>
                    <input class="input" type="text" name="nome" placeholder="Nome" required value="<?= $editar_contato['nome'] ?? '' ?>">
                </div>

                <div class="require_input">
                    <label for=telefone>Telefone*</label>
                    <input class="input" type="tel" name="telefone" minlength="8" maxlength="11" pattern="[0-9]{10,11}" placeholder="( 68 ) 99999-9999" required value="<?= $editar_contato['telefone'] ?? '' ?>">
                </div>
            </div>
            <label for=email>Email</label>
            <input class="input" type="email" name="email" placeholder="exemplo@email.com" value="<?= $editar_contato['email'] ?? '' ?>">

            <label for=empresa>Empresa</label>
            <input class="input" type="text" name="empresa" placeholder="Nome da empresa" value="<?= $editar_contato['empresa'] ?? '' ?>">

            <label for=observacao>Observação</label>
            <textarea class="textarea" name="observacao" placeholder=""><?= $editar_contato['observacao'] ?? '' ?></textarea>

            <?php if ($editar_contato): ?>
                <input type="hidden" name="id_contato" value="<?php echo $editar_contato['id_contato'] ?>">
            <?php endif; ?>
            <button class="btn" type="submit"><?= $editar_contato ? 'Atualizar' : 'Salvar' ?></button>
        </form>


    </div>

    <?php $conn->close(); ?>
</body>

</html>