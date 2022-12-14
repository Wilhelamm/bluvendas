<?php
    include('conexao.php');

    if (isset($_POST['logar'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        $verificaEmail = mysqli_query($mysqli, "select * from cadastro where email = '$email' and senha = '$senha'");

        if (mysqli_num_rows($verificaEmail) > 0) {
            $fetch = mysqli_fetch_object($verificaEmail);
            setcookie("login", $fetch->nome);
            setcookie("idUsuario", $fetch->id_cadastro);
            header("Location: ./index.php");
        } else {
            echo("<script>console.log('PHP: " . 'Erro' . "');</script>");
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
                                <a class="nav-link text-white" href="./criarAnuncio.php">Criar an??ncio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./sobre.php">Sobre n??s</a>
                            </li>
                        </ul>
                        <div class="align-self-end">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="./cadastro.php" class="nav-link text-white">Criar cadastro</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./login.php" class="nav-link text-white">Fazer login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="flex-fill">
                <div class="container text-center">
                    <div class="row justify-content-center">
                        <form class="col-sm-10 col-md-8 col-lg-6" method="post">
                            <h1>Insira seu e-mail e senha</h1>
                            <hr>

                            <div class="form-floating mb-3">
                                <input type="email" id="txtEmail" class="form-control" placeholder=" " name="email"
                                    autofocus>
                                <label for="txtEmail">E-mail</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" id="txtSenha" class="form-control" placeholder=" " name="senha">
                                <label for="txtSenha">Senha</label>
                            </div>

                            <a class="btn btn-lg btn-light btn-outline-dark" href="./index.php">Cancelar</a>
                            <button type="submit" name="logar" class="btn btn-lg btn-dark">Entrar</button>
                        </form>
                    </div>
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