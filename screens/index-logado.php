<?php
include('config.php');
if (isset($_SESSION['usuario'])){
}
else{
echo"<script>alert'erro'</script>";
  header("Location:index.html");
}
if (isset($_POST['sair'])){
  session_destroy();
}
?>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <title>Servicinho</title>
  </head>
  <body>
    <header id="header">
      <section class="header-left">
        <p>&nbsp; Servicinho</p>
      </section>
      <section class="header-right">
        <nav>
          <ul>
            <li><a href="#inicio">Início</a></li>
            <li><a href="#sobre">Sobre</a></li>
            <li><a href="#contato">Contato</a></li>
          </ul>
        </nav>
        <button class="btn-cadastrar" onclick="document.getElementById('modal-login').style.display='flex';">
          <p>Cadastrar</p>
        </button>
        <button class="btn-entrar" onclick="document.getElementById('modal-cadastro').style.display='flex';">
          <p>Sair</p>
        </button>
      </section>
    </header>
    <div id="modal-login">
      <div class="modal-container">
        <header>
          <span></span>
          <h2>Confirmação</h2>
          <img onclick="document.getElementById('modal-login').style.display='none'" src="../assets/images/fechar.png"/>
        </header>
        <div class="modal-content">
          <p>
            Você deseja prosseguir para a página de cadastros?
          </p>
        </div>
        <div class="cadastro-buttons">
          <button class="botao-primario" onclick="document.getElementById('modal-cadastro').style.display='none'">Não</button>
          <button class="botao-secundario" onclick="location.href='./form_cliente.php'">Sim</button>
        </div>
      </div>
    </div>
    <div id="modal-cadastro">
      <div class="modal-container">
        <header>
          <span></span>
          <h2>Cadastro</h2>
          <img onclick="document.getElementById('modal-cadastro').style.display='none'" src="../assets/images/fechar.png"/>
        </header>
        <div class="modal-content">
          <p>
            Você realmente deseja encerrar a sessão?
          </p>
        </div>
        <div class="cadastro-buttons">
          <button class="botao-primario" onclick="document.getElementById('modal-cadastro').style.display='none'">Não</button>
          <button class="botao-secundario" onclick="location.href='./index.html'">Sim</button>
        </div>
      </div>
    </div>
    <main>
      <section id="inicio">
        <article>
          <h1>Servicinho</h1>
          <h3>Importante</h3>
          <p>
            Parabéns, você está logado no sistema e tem acesso à todas as suas funcionalidades.
          </p>
        </article>
        <article class="projeto-logo">
          <img src="../assets/images/eavy-logo.png" width="500" />
        </article>
      </section>
      <section id="sobre">
        <h3>Conheça nossos membros</h3>
        <article class="carousel-membros">
          <div class="card-membros">
            <h5>Luiz Fernando</h5>
            <p>
              Estudante atualmente cursando Desenvolvimento de Sistemas na Etec Adolpho Berezin, 
              curte desenhar, jogar e ler livros, e sempre está em busca de novos hobbies.
            </p>
          </div>
          <div class="card-membros">
            <h5>João Adriano</h5>
            <p>
              Atualmente cursando Desenvolvimento de Sistemas, 
              estudando bastante para não repetir de ano. R passa 
            </p>
          </div>
        </article>
      </section>
      <section id="contato">
        <article>
          <h3>Contato</h3>
          <aside>
            <div class="contato-img">
              <img src="../assets/images/email.png" />
            </div>
            <div>
              <p>luiz.amurim@etec.sp.gov.br</p>
              <p>joao.silva2678@etec.sp.gov.br</p>
            </div>
          </aside>
          <aside>
            <div class="contato-img">
              <img src="../assets/images/instagram.png" />
            </div>
            <div>
              <p>@amurim.luiz</p>
              <p>@jao_s_silva</p>
            </div>
          </aside>
        </article>
      </section>
      <div class="footer">
        <p class="cp-text">
    © Copyright 2023 Servicinho Inc.
</p>
    </main>
  </body>
</html>
