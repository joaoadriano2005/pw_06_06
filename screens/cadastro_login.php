<?php

if(isset($_POST['submit'])) {

  include_once('config.php');

  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $senha2 = $_POST['senha2'];
  $tipo = $_POST['tipo'];
  
  // Verifica se as senhas são iguais
  if($senha == $senha2) {

      $result = mysqli_query($mysqli,"INSERT INTO tb_usuario(email,senha,tipo) 
      VALUES ('$email','$senha', '$tipo')");

      header("Location: login.php");
  } else {
      // Se as senhas não são iguais, exibe uma mensagem de erro
      echo "<script>alert('senhas não coincidem');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/style_cadastros.css" type="text/css" />
  <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
</head>

<body>
  <main>
    <section class="left"></section>
    <section class="cadastro">
      <form method="POST">
        <h3>Cadastro</h3>
        <input type="email" name="email" placeholder="Email" maxlength="80" required>
        <input type="password" name="senha" maxlength="21" placeholder="Senha" required>
        <input type="password" name="senha2" maxlength="21" placeholder="Confirmar senha" required>

        <label class="ls-label col-md-3">
          <b class="ls-label-text">Tipo de usuário</b>
          <div class="ls-custom-select" style="width: 200px;">
            <select class="ls-custom" name="tipo"
              style="border-radius: 15px; padding: 10px; outline: none; font-family: Montserrat;">
              <option selected="selected">Selecionar</option>
              <option value="comum">Comum</option>
              <option value="administrador">Administrador</option>
            </select>
          </div>
        </label>
        <div class="btn-group">
          <button class="btn-back" onclick="location.href='./index.html'">
            <p>Voltar</p>
          </button>
          <button class="btn-submit" type="submit" name="submit">
            <p>Entrar</p>
          </button>
        </div>
      </form>
    </section>
  </main>
</body>

</html>