<?php
    include('conexao.php');

    $listarChat = null;

    if (!isset($_COOKIE['login'])) {
        header("Location: ./login.php");
    }

    $idVendedor = $_COOKIE['idUsuario'];
    $listarContatos = mysqli_query($mysqli, "select * from contato c join produto p on (p.id_produto = c.id_produto) where c.id_vendedor = '$idVendedor' or c.id_comprador = '$idVendedor'");

    if (isset($_GET['idContato'])) {
    $idContato = $_GET['idContato'];
    $listarChat = mysqli_query($mysqli, "select * from chat where id_contato = '$idContato'");

        if (isset($_POST['enviarMensagem'])) {
            $remetente = $_COOKIE['login'];
            $mensagem = $_POST['mensagem'];
            
            
            $query = mysqli_query($mysqli, "insert into chat (id_contato, remetente, mensagem)
            values ('$idContato', '$remetente', '$mensagem')");    

        }
    }
?>

<!doctype html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="./img/favicon/marketplace.png">
        <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" href="./estilos.css">

        <title>Bluvendas</title>
    </head>

    <body>
        <div class="d-flex flex-column wrapper">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom shadow-sm mb-3">
                <div class="container">
                    <a class="navbar-brand" href="./index.php"><b>Bluvendas</b></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navbar-collapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav flex-grow-1">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./chat.php">Chat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./criarAnuncio.php">Criar anúncio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./sobre.php">Sobre nós</a>
                            </li>
                        </ul>
                        <?php
                            echo '<div class="align-self-end">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link text-white">Bem-vindo: ' . $_COOKIE['login'] .'</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./logoff.php" class="nav-link text-white">Logoff</a>
                                    </li>
                                </ul>
                            </div>';                        
                        ?>
                    </div>
                </div>
            </nav>

            <main class="flex-fill">
                <div class="container">
                    <section style="background-color: #eee;">
                        <div class="container py-5">

                            <div class="row">

                                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                                    <h5 class="font-weight-bold mb-3 text-center text-lg-start">Chat</h5>

                                    <div class="card">
                                        <div class="card-body">
                                            <?php
                                            foreach($listarContatos as $row) {
                                            echo '<ul class="list-unstyled mb-0">
                                                <li class="p-2 border-bottom" style="background-color: #eee;">
                                                    <a name="teste" class="d-flex justify-content-between"  href="chat.php?idContato=' . $row['id_contato'] . '">
                                                        <div class="d-flex flex-row">
                                                            <img src="./img/produtos/' . $row['foto'] .'""
                                                                alt="avatar"
                                                                class="rounded-circle d-flex align-self-center me-3 shadow-1-strong"
                                                                width="60">
                                                            <div class="pt-1">
                                                                <p class="fw-bold mb-0">' . $row['tipo_veiculo'] .'</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>';
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-7 col-xl-8" style=" height: 600px; overflow-y: scroll;">
                                    <?php
                                    if (is_array($listarChat) || is_object($listarChat)) {


                                foreach($listarChat as $row) {
                                    echo '<ul class="list-unstyled">
                                        <li class="d-flex justify-content-between mb-4">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between p-3">
                                                    <p class="fw-bold mb-0">' . $row['remetente'] .'</p>
                                                </div>
                                                <div class="card-body">
                                                    <p class="mb-0"> ' . $row['mensagem'] .' </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>';
                                    }

                                    echo '<form method="post">
                                    <div class="form-outline">
                                        <textarea class="form-control" name="mensagem" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-rounded float-end"
                                        name="enviarMensagem">Enviar</button>
                                    </form>';
                                } else {
                                    echo "<h2 style='text-align: center;'>Não existe chat no momento</h2>";
                                }
                                    ?>
                                </div>

                            </div>

                        </div>
                    </section>
                </div>
            </main>

            <footer class="border-top text-muted bg-light">
                <div class="container">
                    <div class="row py-1">
                        <div class="col-12 col-md-4 text-center">
                        </div>

                        <div class="col-12 col-md-4 text-center">
                            &copy; 2022 - Marketplace Bluvendas<br>
                            E-mail: <a href="" class="text-decoration-none text-dark">
                                bluvendas@hotmail.com
                            </a><br>
                            Telefone: <a href="" class="text-decoration-none text-dark">
                                (47) 98400-3632
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>