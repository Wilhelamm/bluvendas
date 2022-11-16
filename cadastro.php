<?php
    include('conexao.php');

    if (isset($_POST['criarCadastro'])) {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $dataNascimento = $_POST['dataNascimento'];
        $senha = $_POST['senha'];
        $senhaConfirmacao = $_POST['senhaConfirmacao'];
        $email = $_POST['email'];

        if ($senha != $senhaConfirmacao or $senha == null or $senhaConfirmacao == null) {
            echo  "<script>alert('As senhas são divergentes ou vazias!');</script>";
        } else if ($nome == null) {
            echo  "<script>alert('O campo nome está vazio!');</script>";
        } else if ($cpf == null ) {
            echo  "<script>alert('O campo cpf está vazio!');</script>";
        } else if ($dataNascimento == null) {
            echo  "<script>alert('A data de nascimento está vazio!');</script>";
        } else {
           $query = mysqli_query($mysqli, "insert into cadastro (nome, cpf, data_nascimento, senha, email) values ('$nome', '$cpf', '$dataNascimento', '$senha', '$email')");
           include('login.php');
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

        <script type="text/javascript">
        function formatar_mascara(src, mascara) {
            var campo = src.value.length;
            var saida = mascara.substring(0, 1);
            var texto = mascara.substring(campo);
            if (texto.substring(0, 1) != saida) {
                src.value += texto.substring(0, 1);
            }
        }
        </script>
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
                    <h1>Insira seus dados</h1>
                    <hr>
                    <form class="mt-3" method="post">
                        <div class="row justify-content-center">
                            <div class="col-sm-10 col-md-8 col-lg-6">
                                <fieldset class="row gx-3">
                                    <legend>Dados Pessoais</legend>
                                    <div class="form-floating mb-3 col-lg-6">
                                        <input class="form-control" type="text" id="txtNome" placeholder=" " name="nome"
                                            autofocus />
                                        <label for="txtNome">Nome</label>
                                    </div>
                                    <div class="form-floating mb-3 col-lg-6">
                                        <input class="form-control" type="email" id="txtEmail" placeholder=" "
                                            name="email" />
                                        <label for="txtEmail">E-mail</label>
                                    </div>
                                    <div class="form-floating mb-3 col-lg-6">
                                        <input class="form-control" type="text" id="txtCPF" placeholder=" " name="cpf"
                                            maxlength="14" onkeypress="formatar_mascara(this,'###.###.###-##')" />
                                        <label for="txtCPF">CPF</label>
                                    </div>
                                    <div class="form-floating mb-3 col-lg-6">
                                        <input class="form-control" type="date" id="txtDataNascimento" placeholder=" "
                                            name="dataNascimento" />
                                        <label for="txtDataNascimento" class="d-inline d-sm-none d-md-inline d-lg-none">Data
                                            Nascimento</label>
                                        <label for="txtDataNascimento" class="d-none d-sm-inline d-md-none d-lg-inline">Data
                                            de Nascimento</label>
                                    </div>
                                </fieldset>
                                <fieldset class="row gx-3">
                                    <legend>Senha de Acesso</legend>
                                    <div class="form-floating mb-3 col-lg-6">
                                        <input class="form-control" type="password" id="txtSenha" placeholder=" "
                                            name="senha" />
                                        <label for="txtSenha">Senha</label>
                                    </div>
                                    <div class="form-floating mb-3 col-lg-6">
                                        <input class="form-control" type="password" id="txtConfirmacaoSenha" placeholder=" "
                                            name="senhaConfirmacao" />
                                        <label class="form-label" for="txtConfirmacaoSenha">Confirmação da Senha</label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="mb-3">
                            <a class="btn btn-lg btn-light btn-outline-dark" href="./index.php">Cancelar</a>
                            <input type="submit" value="Criar meu cadastro" class="btn btn-lg btn-dark"
                                name="criarCadastro" />
                        </div>
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