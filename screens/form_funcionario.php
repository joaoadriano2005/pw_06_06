<?php
if(isset($_POST['submit']))
{

    include_once('config.php');

    $CPF = $_POST['CPF'];
    $nome = $_POST['nome'];
    $bairro = $_POST['bairro'];
    $fone = $_POST['fone'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $imagem = $_FILES['imagem']['tmp_name'];

    $conteudo = file_get_contents($imagem);

    $stmt = $mysqli->prepare("INSERT INTO tb_funcionario(nr_cpf,nm_funcionario,nm_endereco,nr_telefone,nm_bairro,nm_cidade,nr_cep,imagem)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss",$CPF,$nome,$endereco,$fone,$bairro,$cidade,$cep,$conteudo);
   
    if ($stmt->execute()) {
        echo "<script>alert('Registro inserido com sucesso.');</script>";
    } else {
        echo "<script>alert('Erro ao inserir registro: ');</script>" . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
	
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro funcionário</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style_cadastros.css" type="text/css" />
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
</head>

<body>
    <main>
        <section class="right"></section>
        <section class="cadastro">
            <form method="POST" enctype="multipart/form-data">
                <h3>Cadastrar funcionário</h3>
                <input type="text" name="nome" maxlength="50" placeholder="Nome" required>
                <input type="text" name="endereco" maxlength="50" placeholder="Endereço" required>
                <input type="text" name="fone" maxlength="11" placeholder="Telefone" required>
                <input type="text" name="bairro" maxlength="50" placeholder="Bairro" required>
                <input type="text" name="cidade" maxlength="50" placeholder="Cidade" required>
                <input type="text" name="cep" maxlength="8" placeholder="CEP" required>
                <input type="text" name="CPF" maxlength="11" placeholder="CPF" required>
                <input type="file" name="imagem">
                <div class="btn-group">
                    <button class="btn-back" onclick="location.href='./index.html'">
                        <p>Voltar</p>
                    </button>
                    <button class="btn-submit" type="submit" name="submit">
                        <p>Enviar</p>
                    </button>
                </div>
            </form>
        </section>
        <div class="navigation">
            <div class="menuToggle"></div>
            <ul>

                <li class="list" style="--clr:#f44336;">
                    <a href="index-logado.html">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li class="list" style="--clr:#ffa117;">
                    <a href="form_cliente.php">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="text">Cliente</span>
                    </a>
                </li>
                <li class="list active" style="--clr:#0fc70f;">
                    <a href="form_funcionario.php">
                        <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                        <span class="text">Funcionário</span>
                    </a>
                </li>
                <li class="list" style="--clr:#2196f3;">
                    <a href="form_fornecedor.php">
                        <span class="icon"><ion-icon name="airplane-outline"></ion-icon></span>
                        <span class="text">Fornecedor</span>
                    </a>
                </li>
                <li class="list" style="--clr:#b145e9;">
                    <a href="form_produto.php">
                        <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                        <span class="text">Produto</span>
                    </a>
                </li>
            </ul>
        </div>
        <script>
            const menuToggle = document.querySelector('.menuToggle');
            const navigation = document.querySelector('.navigation');
            menuToggle.onclick = function () {
                navigation.classList.toggle('open')
            }

            const list = document.querySelectorAll('.list');
            function activeLink() {
                list.forEach((item) =>
                    item.classList.remove('active'));
                this.classList.add('active');
            }
            list.forEach((item) =>
                item.addEventListener('click', activeLink));
        </script>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </main>
</body>

</html>