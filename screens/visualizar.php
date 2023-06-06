<?php
include_once('config.php');
$name = $_GET['name'];
$table = "";

if ($name == "cliente") {
    $table = "tb_cliente";
} elseif ($name == "fornecedor") {
    $table = "tb_fornecedor";
} elseif ($name == "funcionario") {
    $table = "tb_funcionario";
} elseif ($name == "produto") {
    $table = "tb_produto";
}
// Resto do seu código usando a variável $table conforme necessário

$id = $_GET['id'];
$sql = "SELECT imagem FROM " . $table . " WHERE id = ?";
$stmt = $mysqli->prepare($sql);
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Associa o valor do ID ao parâmetro da consulta
        $stmt->bind_param("i", $id);

        // Executa a consulta
        if ($stmt->execute()) {
            // Vincula o resultado da consulta a uma variável
            $stmt->bind_result($imagem_blob);

            // Verifica se há resultados
            if ($stmt->fetch()) {
                // Cria um recurso de imagem a partir dos dados decodificados
                $imagem = imagecreatefromstring($imagem_blob);

                // Verifica se a criação da imagem foi bem-sucedida
                if ($imagem !== false) {
                    // Define o cabeçalho apropriado para exibir a imagem
                    header("Content-Type: image/png");
                    imagepng($imagem);
                } else {
                    echo "Erro ao criar a imagem.";
                }

                // Libera a memória ocupada pela imagem
                imagedestroy($imagem);
            } else {
                echo "Nenhuma imagem encontrada para o ID fornecido.";
            }
        } else {
            echo "Erro ao executar a consulta: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $mysqli->error;
    }

// Fecha a conexão com o banco de dados
$mysqli->close();
?>
