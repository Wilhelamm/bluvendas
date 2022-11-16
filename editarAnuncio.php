<?php
    include('conexao.php');

    if (!isset($_COOKIE['login'])) {
        header("Location: ./login.php");
    }

    $idProduto = $_GET['idProduto'];

    $produto = mysqli_query($mysqli, "select * from produto where id_produto = '$idProduto'");
    $fetch = mysqli_fetch_object($produto);
    $fotoAtual = $fetch->foto;

    if (isset($_POST['editar'])) {
        $tipoVeiculo = $_POST['tipoVeiculo'];
        $descricao = $_POST['descricao'];
        $quilometragem = $_POST['quilometragem'];
        $cor = $_POST['cor'];
        $preco = $_POST['preco'];

        $extensao = strtolower(strrchr($_FILES['foto']['name'], '.'));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "img/produtos/";

        move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novo_nome);

        if ($_FILES['foto']['name'] != null) {
            $query = mysqli_query($mysqli, "update produto set tipo_veiculo = '$tipoVeiculo', descricao = '$descricao', quilometragem = '$quilometragem', cor = '$cor', preco = '$preco', foto = '$novo_nome'  where id_produto = '$idProduto'");
        } else {
            $query = mysqli_query($mysqli, "update produto set tipo_veiculo = '$tipoVeiculo', descricao = '$descricao', quilometragem = '$quilometragem', cor = '$cor', preco = '$preco', foto = '$fotoAtual' where id_produto = '$idProduto'");
        }
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
                    <?php
                    foreach($produto as $row) {
                    echo '<form method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputEmail4">Tipo veículo</label>
                                <input type="text" class="form-control" placeholder="Tipo do veículo" name="tipoVeiculo" value="' . $row['tipo_veiculo'] .'">
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea type="text" class="form-control" name="descricao" placeholder="Descrição do veículo" rows="5">' . $row['descricao'] .'</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Quilometragem</label>
                            <input type="text" class="form-control" placeholder="Quilometragem" name="quilometragem" value="' . $row['quilometragem'] .'">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Cor </label>
                            <input type="text" class="form-control" placeholder="Cor" name="cor" value="' . $row['cor'] .'">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputCity">Preço</label>
                                <input type="text" class="form-control" name="preco" value="' . $row['preco'] .'">
                            </div>
                        </div>
                        <p></p>
                        <div>
                            <input type="file" class="form-control" name="foto"/>
                        </div>
                        <p></p>
                        <button type="submit" name="editar" class="btn btn-lg btn-dark">Editar</button>
                    </form>';
                    }
                    ?>
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