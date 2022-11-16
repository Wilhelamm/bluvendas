<?php
    include('conexao.php');

    if (!isset($_COOKIE['login'])) {
        header("Location: ./login.php");
    }

    $listarProdutos = mysqli_query($mysqli, "select * from produto");

    if (isset($_POST['buscarAnuncio'])) {
        $textoProcura = $_POST['textoProcura'];

        if ($textoProcura != null) {
            $listarProdutos = mysqli_query($mysqli, "select * from produto where tipo_veiculo like '%$textoProcura%'");
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
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <form method="post" class="justify-content-center justify-content-md-start mb-3 mb-md-0">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Digite aqui o que procura" name="textoProcura">
                                    <button class="btn btn-dark" name="buscarAnuncio">Buscar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
                                <form class="d-inline-block">
                                    <select class="form-select form-select-sm">
                                        <option>Ordenar pelo nome</option>
                                        <option>Ordenar pelo menor preço</option>
                                        <option>Ordenar pelo maior preço</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr mt-3>

                    <div class="row g-3">
                        <?php
                        foreach($listarProdutos as $row) {
                            echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card text-center bg-light">
                                    <a href="./produto.php?param=' . $row['id_produto'] . '">
                                        <img src="./img/produtos/' . $row['foto'] .'" class="card-img-top imagens" alt="Sem imagem.">
                                    </a>
                                    <div class="card-header">
                                        R$ ' . $row['preco'] .'
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['tipo_veiculo'] .'</h5>
                                        <p class="card-text limite-caracteres">
                                        ' . $row['descricao'] .'
                                        </p>
                                    </div>
                                </div>
                            </div>';
                        }
                        ?>   
                    </div>

                    <hr class="mt-3">
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