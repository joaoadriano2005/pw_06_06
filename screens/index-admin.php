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
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <style>
    input[type=text] {
      width: 45vw;
      box-sizing: border-box;
      font-size: 18px;
      background-color: #fcfcfc;
      padding: 20px 10px 3px 40px;
      outline: none;
      border: none;
      border-bottom: solid black 1px;
    }

    .carousel-pesquisa {
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 100%;
    flex-wrap: nowrap;
    align-content: center;
    flex-direction: column;
}

    .card-pesquisa {
      min-width: 300px;
      min-height: 300px;
      width: 50vw;
      background-color: #fcfcfc;
      margin: 10px;
      box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.25);
      padding: 20px;
    }

    .card-pesquisa h5 {
      width: fit-content;
      padding: 4px 3px;
      margin-bottom: 20px;
      border-bottom: 2px solid #96c56f;
    }

    .pesquisar-logo {
      background-image: url(../assets/images/pesquisa-logo.png);
      background-size: cover;
      background-color: transparent;
      position: absolute;
      width: 35px;
      height: 35px;
      border: none;
    }
  </style>
  <title>Servicinho - admin</title>
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
          <li><a href="#sobre">Pesquisa</a></li>
        </ul>
      </nav>
      <button class="btn-entrar" onclick="document.getElementById('modal-cadastro').style.display='flex';">
        <p>Sair</p>
      </button>
    </section>
  </header>
  <div id="modal-login">
    <div class="modal-container">
      <header>
        <span></span>
        <h2>Login</h2>
        <img onclick="document.getElementById('modal-login').style.display='none'" src="../assets/images/fechar.png" />
      </header>
      <div class="modal-content">
        <p>
          Com qual login deseja prosseguir?
        </p>
      </div>
      <div class="cadastro-buttons">
        <button class="botao-primario" onclick="location.href='./login.php'">Login de usuário</button>
        <button class="botao-secundario" onclick="location.href='./login-admin.php'">Login admnistrativo</button>
      </div>
    </div>
  </div>
  <div id="modal-cadastro">
    <div class="modal-container">
      <header>
        <span></span>
        <h2>Confirmação</h2>
        <img onclick="document.getElementById('modal-cadastro').style.display='none'" src="../assets/images/fechar.png" />
      </header>
      <div class="modal-content">
        <p>
          Você realmente deseja encerrar a sessão?
        </p>
      </div>
      <div class="cadastro-buttons">
        <button class="botao-primario" onclick="document.getElementById('modal-cadastro').style.display='none'">Não</button>
        <button class="botao-secundario" onclick="location.href='./index.html'" name="sair">Sim</button>
      </div>
    </div>
  </div>
  <main>
    <section id="inicio">
      <article>
        <h1>Servicinho</h1>
        <h3>Serviço administrativo</h3>
        <p>
          Serviço administrativo com funcionalidades de pesquisa de informações do Banco de Dados.
        </p>
      </article>
      <article class="projeto-logo">
        <img src="../assets/images/eavy-logo.png" width="500" />
      </article>
    </section>
    <section id="sobre">
      <h3>Sistema de busca</h3>
      <article class="carousel-pesquisa">
        <div class="card-pesquisa">
          <h5>Usuário</h5>
          <form>
            <input name="busca1" value="<?php if (isset($_GET['busca1'])) echo $_GET['busca1']; ?>" placeholder="Pesquisar" type="text">
            &nbsp;
            <button class="pesquisar-logo" type="submit" name="usuario"></button>
          </form>
          <br>
          <table>
            <thead>
              <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Email</th>
                <th>Senha</th>
              </tr>
            </thead>
            <?php
            if (!isset($_GET['busca1'])) {
            ?>
              <tr>
                <td colspan="3">Digite algo para pesquisar...</td>
              </tr>
              <?php
            } else {
              $pesquisa = $mysqli->real_escape_string($_GET['busca1']);
              $sql_code = "SELECT * 
                FROM tb_usuario 
                WHERE id LIKE '%$pesquisa%'
				OR tipo LIKE '%$pesquisa%'
                OR email LIKE '%$pesquisa%'
                OR senha LIKE '%$pesquisa%'";
              $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);

              if ($sql_query->num_rows == 0) {
              ?>
                <tr>
                  <td colspan="3">Nenhum resultado encontrado...</td>
                </tr>
                <?php
              } else {
                while ($dados = $sql_query->fetch_assoc()) {
                ?>
                  <tr>
                    <td>
                      <?php echo $dados['id']; ?>
                    </td>
                    <td>
                      <?php echo $dados['tipo']; ?>
                    </td>
                    <td>
                      <?php echo $dados['email']; ?>
                    </td>
                    <td>
                      <?php echo $dados['senha']; ?>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            <?php
            } ?>
          </table>
        </div>

        <div class="card-pesquisa">
          <h5>Cliente</h5>
          <form enctype="multipart/form-data">
            <input name="busca2" value="<?php if (isset($_GET['busca2'])) echo $_GET['busca2']; ?>" placeholder="Pesquisar" type="text">
            &nbsp;
            <button class="pesquisar-logo" type="submit" name="cliente"></button>
          </form>
          <br>
          <table>
            <thead>
              <tr>
                <th>Código</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>CEP</th>
                <th>Imagem</th>
              </tr>
            </thead>
            <?php
            if (!isset($_GET['busca2'])) {
            ?>
              <tr>
                <td colspan="3">Digite algo para pesquisar...</td>
              </tr>
              <?php
            } else {
              $pesquisa = $mysqli->real_escape_string($_GET['busca2']);
              $sql_code = "SELECT *
                FROM tb_cliente 
                WHERE id LIKE '%$pesquisa%'
                OR nr_cpf LIKE '%$pesquisa%'
				        OR nm_cliente LIKE '%$pesquisa%'
                OR nr_telefone LIKE '%$pesquisa%'
                OR nm_endereco LIKE '%$pesquisa%'
                OR nm_bairro LIKE '%$pesquisa%'
                OR nm_cidade LIKE '%$pesquisa%'
                OR nr_cep LIKE '%$pesquisa%'
               ";

              $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);

              if ($sql_query->num_rows == 0) {
              ?>
                <tr>
                  <td colspan="3">Nenhum resultado encontrado...</td>
                </tr>
                <?php
              } else {
                while ($dados = $sql_query->fetch_assoc()) {
                ?>
                  <tr>
                    <td>
                      <?php echo $dados['id']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nr_cpf']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_cliente']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nr_telefone']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_endereco']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_bairro']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_cidade']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nr_cep']; ?>
                    </td>
                    <td>
                     <?php echo '<a href="visualizar.php?id=' . $dados['id'] . '&name=cliente">Imagem</a>'; ?>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            <?php
            } ?>
          </table>
        </div>

        <div class="card-pesquisa">
          <h5>Funcionário</h5>
          <form enctype="multipart/form-data">
            <input name="busca3" value="<?php if (isset($_GET['busca3'])) echo $_GET['busca3']; ?>" placeholder="Pesquisar" type="text">
            &nbsp;
            <button class="pesquisar-logo" type="submit" name="funcionario"></button>
          </form>
          <br>
          <table>
            <thead>
              <tr>
                <th>Código</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>CEP</th>
                <th>Imagem</th>
              </tr>
            </thead>
            <?php
            if (!isset($_GET['busca3'])) {
            ?>
              <tr>
                <td colspan="3">Digite algo para pesquisar...</td>
              </tr>
              <?php
            } else {
              $pesquisa = $mysqli->real_escape_string($_GET['busca3']);
              $sql_code = "SELECT *
                FROM tb_funcionario 
                WHERE id LIKE '%$pesquisa%'
                OR nr_cpf LIKE '%$pesquisa%'
				        OR nm_funcionario LIKE '%$pesquisa%'
                OR nr_telefone LIKE '%$pesquisa%'
                OR nm_endereco LIKE '%$pesquisa%'
                OR nm_bairro LIKE '%$pesquisa%'
                OR nm_cidade LIKE '%$pesquisa%'
                OR nr_cep LIKE '%$pesquisa%'
               ";

              $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);

              if ($sql_query->num_rows == 0) {
              ?>
                <tr>
                  <td colspan="3">Nenhum resultado encontrado...</td>
                </tr>
                <?php
              } else {
                while ($dados = $sql_query->fetch_assoc()) {
                ?>
                  <tr>
                    <td>
                      <?php echo $dados['id']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nr_cpf']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_funcionario']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nr_telefone']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_endereco']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_bairro']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_cidade']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nr_cep']; ?>
                    </td>
                    <td>
                     <?php echo '<a href="visualizar.php?id=' . $dados['id'] . '&name= funcionario">Imagem</a>'; ?>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            <?php
            } ?>
          </table>
        </div>
        <div class="card-pesquisa">
          <h5>Fornecedor</h5>
          <form enctype="multipart/form-data">
            <input name="busca4" value="<?php if (isset($_GET['busca4'])) echo $_GET['busca4']; ?>" placeholder="Pesquisar" type="text">
            &nbsp;
            <button class="pesquisar-logo" type="submit" name="funcionario"></button>
          </form>
          <br>
          <table>
            <thead>
              <tr>
                <th>Código</th>
                <th>CNPJ</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>CEP</th>
                <th>Imagem</th>
              </tr>
            </thead>
            <?php
            if (!isset($_GET['busca4'])) {
            ?>
              <tr>
                <td colspan="3">Digite algo para pesquisar...</td>
              </tr>
              <?php
            } else {
              $pesquisa = $mysqli->real_escape_string($_GET['busca4']);
              $sql_code = "SELECT *
                FROM tb_fornecedor 
                WHERE id LIKE '%$pesquisa%'
                OR nr_cnpj LIKE '%$pesquisa%'
				        OR nm_fornecedor LIKE '%$pesquisa%'
                OR nr_telefone LIKE '%$pesquisa%'
                OR nm_endereco LIKE '%$pesquisa%'
                OR nm_bairro LIKE '%$pesquisa%'
                OR nm_cidade LIKE '%$pesquisa%'
                OR nr_cep LIKE '%$pesquisa%'
               ";

              $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);

              if ($sql_query->num_rows == 0) {
              ?>
                <tr>
                  <td colspan="3">Nenhum resultado encontrado...</td>
                </tr>
                <?php
              } else {
                while ($dados = $sql_query->fetch_assoc()) {
                ?>
                  <tr>
                    <td>
                      <?php echo $dados['id']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nr_cnpj']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_fornecedor']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nr_telefone']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_endereco']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_bairro']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_cidade']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nr_cep']; ?>
                    </td>
                    <td>
                     <?php echo '<a href="visualizar.php?id=' . $dados['id'] . '&name= fornecedor">Imagem</a>'; ?>


                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            <?php
            } ?>
          </table>
        </div>
        <div class="card-pesquisa">
          <h5>Produto</h5>
          <form enctype="multipart/form-data">
            <input name="busca5" value="<?php if (isset($_GET['busca5'])) echo $_GET['busca5']; ?>" placeholder="Pesquisar" type="text">
            &nbsp;
            <button class="pesquisar-logo" type="submit" name="funcionario"></button>
          </form>
          <br>
          <table>
            <thead>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Estoque</th>
                <th>Imagem</th>
              </tr>
            </thead>
            <?php
            if (!isset($_GET['busca5'])) {
            ?>
              <tr>
                <td colspan="3">Digite algo para pesquisar...</td>
              </tr>
              <?php
            } else {
              $pesquisa = $mysqli->real_escape_string($_GET['busca5']);
              $sql_code = "SELECT *
                FROM tb_produto
                WHERE id LIKE '%$pesquisa%'
				        OR nm_produto LIKE '%$pesquisa%'
                OR ds_produto LIKE '%$pesquisa%'
                OR vl_produto LIKE '%$pesquisa%'
                OR qt_estoque LIKE '%$pesquisa%'
               ";

              $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);

              if ($sql_query->num_rows == 0) {
              ?>
                <tr>
                  <td colspan="3">Nenhum resultado encontrado...</td>
                </tr>
                <?php
              } else {
                while ($dados = $sql_query->fetch_assoc()) {
                ?>
                  <tr>
                    <td>
                      <?php echo $dados['id']; ?>
                    </td>
                    <td>
                      <?php echo $dados['nm_produto']; ?>
                    </td>
                    <td>
                      <?php echo $dados['ds_produto']; ?>
                    </td>
                    <td>
                      <?php echo $dados['vl_produto']; ?>
                    </td>
                    <td>
                      <?php echo $dados['qt_estoque']; ?>
                    </td>
                    <td>
                     <?php echo '<a href="visualizar.php?id=' . $dados['id'] . '&name= produto">Imagem</a>'; ?>


                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            <?php
            } ?>
          </table>
        </div>
      </article>
    </section>
    <div class="footer">
      <p class="cp-text">
        © Copyright 2023 Servicinho Inc.
      </p>
  </main>
</body>

</html>