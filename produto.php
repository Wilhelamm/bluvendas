<?php
    include('conexao.php');

    if (!isset($_COOKIE['login'])) {
        header("Location: ./login.php");
    }

    $param = $_GET['param'];

    $listarProdutos = mysqli_query($mysqli, "select * from produto where id_produto = '$param'");

    $fetch = mysqli_fetch_object($listarProdutos);
    $idVendedor = $fetch->id_vendedor;
    $idComprador = $_COOKIE['idUsuario'];
    $remetente = $_COOKIE['login'];

    if (isset($_POST['iniciarConversa'])) {
        $verificaChat = mysqli_query($mysqli, "select * from contato where id_produto = '$param' and id_vendedor = '$idVendedor' and id_comprador = '$idComprador'");

        if ($verificaChat->num_rows == 0) {

            $query = mysqli_query($mysqli, "insert into contato (id_produto, id_vendedor, id_comprador) values ('$param', '$idVendedor', '$idComprador')");

            $listarContato = mysqli_query($mysqli, "select * from contato where id_produto = '$param' and id_vendedor = '$idVendedor' and id_comprador = '$idComprador'");
            $fetchContato = mysqli_fetch_object($listarContato);
            $idContato = $fetchContato->id_contato;
            $nomeComprador = $_COOKIE['login'];

            $queryChat = mysqli_query($mysqli, "insert into chat (id_contato, remetente, mensagem) values ('$idContato', '$nomeComprador', 'Isto ainda está disponível?')");  

        }
        header("Location: ./chat.php");
    }

    if (isset($_POST['excluir'])) {
        $query = mysqli_query($mysqli, "delete from produto where id_produto = '$param'");
        header("Location: ./index.php");
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

                    <form class="mt-3" method="post">
                        <hr mt-3>
                        <div class="row g-3 justify-content-center">
                            <div class="col-12 col-sm-6 col-md-4" style="text-align:center">
                                <?php
                                    foreach($listarProdutos as $row) {
                                        echo '<div class="card text-center bg-light">
                                            <a>
                                                <img src="./img/produtos/' . $row['foto'] .'" class="card-img-top imagens" alt="Sem imagem.">
                                            </a>
                                            <div class="card-header">
                                                R$ ' . $row['preco'] .'
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">' . $row['tipo_veiculo'] .'</h5>
                                                <p class="card-text">
                                                    Descrição: ' . $row['descricao'] .'
                                                </p>
                                                <p class="card-text">
                                                    Quilometragem: ' . $row['quilometragem'] .'km
                                                </p>
                                                <p class="card-text">
                                                    Cor: ' . $row['cor'] .'
                                                </p>    
                                            </div>
                                        </div>';
                                    }

                                ?>
                                <?php
                                if ($_COOKIE['idUsuario'] != $row['id_vendedor']) {
                                echo '<input type="submit" value="Iniciar conversa" class="btn btn-lg btn-dark col-12" name="iniciarConversa" />';
                                } else {
                                    foreach($listarProdutos as $row) {
                                        echo '<button type="submit" class="btn btn-lg btn-dark col-5" name="excluir">Excluir</button>
                                        <a href="./editarAnuncio.php?idProduto=' . $row['id_produto'] . '" class="btn btn-lg col-5 btn-dark">Editar</a>';                  
                                }
                            }
                                ?>              
                            </div>
                        </div>
                        <hr class="mt-3">
                    </form>
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