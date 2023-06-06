<?php
if (isset($_POST['submit'])) {

    include_once('config.php');

    $nomeProduto = $_POST['nm'];
    $ds_produto = $_POST['ds'];
    $vl_produto = $_POST['vl'];
    $qt_estoque = $_POST['qt'];
    $imagem = $_FILES['imagem']['tmp_name'];

    $conteudo = file_get_contents($imagem);

    $stmt = $mysqli->prepare("INSERT INTO tb_produto(nm_produto, ds_produto, vl_produto, qt_estoque,imagem)
    VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdds", $nomeProduto, $ds_produto, $vl_produto, $qt_estoque, $conteudo);

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
    <title>teste</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style_cadastros.css" type="text/css" />
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
</head>

<body>
    <main>
        <section class="right"></section>
        <section class="cadastro">
            <form method="POST" enctype="multipart/form-data">
                <h3>Cadastrar produto</h3>
                <input type="text" name="nm" placeholder="Nome" maxlength="50" required>
                <input type="textarea" name="ds" placeholder="Descrição" maxlength="80" required>
                <input type="text" name="vl" placeholder="Valor" required>
                <input type="text" name="qt" placeholder="Quantidade em estoque" required>
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
                <li class="list" style="--clr:#0fc70f;">
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
                <li class="list active" style="--clr:#b145e9;">
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
            menuToggle.onclick = function() {
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