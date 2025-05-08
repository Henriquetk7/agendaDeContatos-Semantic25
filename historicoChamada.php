<?php include 'conn/conexao.php'; ?>


<?php
$result = $conn->query("SELECT nome, telefone, data_hora FROM historico_chamada");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@100..700&family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@300;400&family=Staatliches&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles/historicoChamada.css?v=<?= time(); ?>">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <a class="back" href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                </svg>
            </a>
            <h1 class="title">Chamadas recentes</h1>
        </div>
        <ul class="list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list_item">

                    <div class="item_container">
                        <div class="perfil_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                        </div>
                        <div class="contact_info">
                            <span class="contact_name">
                                <?php echo $row["nome"]; ?>
                            </span>
                            <span class="phone_number">
                                <?php echo $row["telefone"]; ?>
                            </span>
                        </div>
                    </div>
                    <span class="date_time">
                        <?php echo $row["data_hora"]; ?>
                    </span>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <?php $conn->close(); ?>
</body>

</html>