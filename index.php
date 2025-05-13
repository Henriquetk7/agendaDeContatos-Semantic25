<?php include 'conn/conexao.php'; ?>

<?php
//READ
$result = $conn->query("SELECT 
  c.id_contato,
  c.nome,
  c.telefone,
  t.descricao AS tipo_contato
FROM 
  contatos c
INNER JOIN 
  tipo_contato t ON c.id_tipo_contato = t.id
ORDER BY c.nome ASC");



//DELETE
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $conn->query("DELETE FROM contatos WHERE id_contato=$id");
    header("Location: index.php");
    exit();
}

//DELETE ALL
if (isset($_GET["deleteAll"])) {
    $conn->query("DELETE FROM contatos");
    header("Location: index.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css?v=<?= time(); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@100..700&family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@300;400&family=Staatliches&display=swap" rel="stylesheet">

    <title>Meus contatos</title>
</head>

<body>
    <div class="container">

        <div class="header">
            <div class="wrapper">
                <h1 class="title">Meus contatos</h1>
                <div class="historico">
                    <a class="chamada_recente" href="historicoChamada.php">Chamadas recentes</a>
                </div>
            </div>
            <a class="btn" href="tipoContato.php" title="Adicionar contato">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-plus bi-phone" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                    <path fill-rule="evenodd" d="M12.5 1a.5.5 0 0 1 .5.5V3h1.5a.5.5 0 0 1 0 1H13v1.5a.5.5 0 0 1-1 0V4h-1.5a.5.5 0 0 1 0-1H12V1.5a.5.5 0 0 1 .5-.5" />
                </svg>
            </a>
        </div>


        <div class="sub_info">
            <p class="total_contacts">Total de contatos: <?= $result->num_rows ?></p>

            <?php if ($result->num_rows > 0) { ?>
                <a class="apagar_todos" href="index.php?deleteAll" onclick="return confirm('Você deseja apagar todos os contatos?')">Apagar todos</a>
            <?php
            }
            ?>

        </div>
        <div class="message_alert">
            <?php
            if ($result->num_rows == 0) {
                echo '<img src="img/phone-alert.png" alt="">';
                echo '<p>Você ainda não adicionou nenhum contato.</p>';
            }
            ?>

        </div>
        <ul class="list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list_item">
                    <div class="person_name">
                        <div class="perfil_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                        </div>
                        <div class="contact_info">
                            <span class="contact_name"><?php echo $row["nome"]; ?></span>
                            <span class="phone_number">
                                <?php echo $row["telefone"]; ?>
                            </span>
                        </div>
                    </div>
                    <div class="actions">
                        <a class="actions_icons" title="Editar" href="formContato.php?edit=<?= $row["id_contato"]; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                            </svg>
                        </a>
                        <a class="actions_icons" title="Excluir" href=" index.php?delete=<?= $row["id_contato"]; ?>" onclick="return confirm('Você tem certeza que deseja excluir este contato?');">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>
                        </a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>



    <?php $conn->close(); ?>
</body>

</html>