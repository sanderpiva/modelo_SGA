<?php

    $codigoConteudo = $_POST["codigoConteudo"];
    $tituloConteudo = $_POST["tituloConteudo"];
    $descricaoConteudo = $_POST["descricaoConteudo"];
    $data_postagem = $_POST["data_postagem"];
    $professor = $_POST["professor"];
    $disciplina = $_POST["disciplina"];
    $tipo_conteudo = $_POST["tipo_conteudo"];
    $id_disciplina = $_POST["id_disciplina"];
    
    //conexao.php
    include '../conexao.php';

    $sql = "INSERT INTO conteudo VALUES (NULL, '$codigoConteudo', '$tituloConteudo', '$descricaoConteudo', '$data_postagem', '$professor', '$disciplina', '$tipo_conteudo', '$id_disciplina')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Dados inseridos com sucesso!</p>";
        echo '<p><a href="../../../servicos_professor/pagina_servicos_professor.php" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Dashboard</a></p>';
    } else {
        echo "<p>Erro ao inserir dados: " . $conn->error . "</p>";
        echo '<p><a href="formConteudo.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';
    }

    $conn->close();

?>