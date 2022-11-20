<?php
    include('conexao.php');

    if (!isset($_COOKIE['login'])) {
        header("Location: ./login.php");
    }

    if (isset($_POST['enviar']) and isset($_FILES['foto'])) {
        $idUsuario = $_COOKIE['idUsuario'];
        $tipoVeiculo = $_POST['tipoVeiculo'];
        $descricao = $_POST['descricao'];
        $quilometragem = $_POST['quilometragem'];
        $cor = $_POST['cor'];
        $preco = $_POST['preco'];

        if ($tipoVeiculo == null) {
            echo  "<script>alert('O campo tipo veículo está vazio');</script>";
        } else if ($descricao == null) {
            echo  "<script>alert('O campo descrição está vazio');</script>";
        } else if ($quilometragem == null) {
            echo  "<script>alert('O campo quilometragem está vazio');</script>";
        } else if ($cor == null) {
            echo  "<script>alert('O campo cor está vazio');</script>";
        } else if ($preco == null) {
            echo  "<script>alert('O campo preco está vazio');</script>";
        } else if ($_FILES['foto']['name'] == null) {
            echo  "<script>alert('O campo imagem está vazio');</script>";
        } else {
            $extensao = strtolower(strrchr($_FILES['foto']['name'], '.'));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "./img/produtos/";

            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novo_nome);

            $query = mysqli_query($mysqli, "insert into produto (id_vendedor, tipo_veiculo, descricao, quilometragem, cor, preco, foto)
            values ('$idUsuario', '$tipoVeiculo', '$descricao', '$quilometragem', '$cor', '$preco', '$novo_nome')");

            header("Location: ./index.php");
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
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputEmail4">Tipo veículo</label>
                                <input type="text" class="form-control" placeholder="Honda Civic" name="tipoVeiculo">
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea type="text" class="form-control" placeholder="Carro em bom estado, ano 2015 edição especial, ABS nas 4 rodas, direção elétrica..." name="descricao" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Quilometragem</label>
                            <input type="text" class="form-control" placeholder="45.000" name="quilometragem">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Cor </label>
                            <input type="text" class="form-control" placeholder="Azul" name="cor">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputCity">Preço</label>
                                <input type="text" class="form-control" placeholder="20.000" name="preco">
                            </div>
                        </div>
                        <p></p>
                        <div>
                            <input type="file" class="form-control" name="foto" />
                        </div>
                        <p></p>
                        <button type="submit" name="enviar" class="btn btn-lg btn-dark">Enviar anúncio</button>
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