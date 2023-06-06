<?php
include('config.php');
if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "<script>alert('Preencha seu e-mail')</script>";
    } else if(strlen($_POST['senha']) == 0) {
        echo "<script>alert('Preencha sua senha')</script>";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM tb_usuario WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            // Verifica o tipo de usuário
            if($usuario['tipo'] == 'administrador') {
                header("Location: index-admin.php");
            } else {
                header("Location: index-logado.html");
            }

        } else {
            echo "<script>alert('Falha ao logar! E-mail ou senha incorretos')</script>";
        }

    }

}
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style_cadastros.css" type="text/css" />
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
</head>

<body>
    <main>
        <section class="left"></section>
        <section class="cadastro">
            <form method="POST">
                <h3>Login</h3>
                <input type="email" name="email" placeholder="Email" maxlength="80" required>
                <input type="password" name="senha" maxlength="21" placeholder="Senha" required>
                <div class="btn-group">
                    <button class="btn-back" onclick="location.href='./index.html'">
                        <p>Voltar</p>
                    </button>
                    <button class="btn-submit" type="submit">
                        <p>Entrar</p>
                    </button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>