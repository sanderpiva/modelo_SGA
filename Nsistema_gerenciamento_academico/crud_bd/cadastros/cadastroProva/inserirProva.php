<?php

    $codigoProva = $_POST["codigoProva"];
    $tipo_prova = $_POST["tipo_prova"];
    $disciplina = $_POST["disciplina"];
    $conteudo = $_POST["conteudo"];
    $data_prova = $_POST["data_prova"];
    $professor = $_POST["professor"];
    $codigoQuestaoProva = $_POST["codigoQuestaoProva"];
    
    //conexao.php
    include '../conexao.php';

    $sql = "INSERT INTO prova VALUES (NULL, '$codigoProva', '$tipo_prova', '$disciplina', '$conteudo', '$data_prova', '$professor', '$codigoQuestaoProva')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Dados inseridos com sucesso!</p>";
        echo '<p><a href="../../../servicos_professor/pagina_servicos_professor.php" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Dashboard</a></p>';
    } else {
        
        $erro = $conn->error;
        // Verifica se o erro é de chave estrangeira (MySQL error code 1452)
        if ($conn->errno == 1452) {
          echo "<p style='color: red;'>Erro: É necessário cadastrar primeiro as provas e as questões antes de inserir uma disciplina.</p>";
        } elseif (strpos($erro, "Column count doesn't match value count") !== false) {
          echo "<p style='color: orange;'>Erro: Insira primeiro os dados de questão de prova e prova.</p>";
        } else {
            echo "<p>Erro ao inserir dados: " . $erro . "</p>";
        } 
        echo '<p><a href="formProva.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';

    }

    $conn->close();

?>



