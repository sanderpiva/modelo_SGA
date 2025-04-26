<?php

    $codigoRespostas = $_POST["codigoRespostas"];
    $respostaDada = $_POST["respostaDada"];
    $acertou = $_POST["acertou"];
    $nota = $_POST["nota"];
    $id_questao = $_POST["id_questao"]; 
    $id_prova = $_POST["id_prova"]; 
    $id_disciplina = $_POST["id_disciplina"];
    $id_professor = $_POST["id_professor"];
    //echo $codigoRespostas;
  
    //echo $codigoQuestaoProva;
    //conexao.php
    include '../conexao.php';

    $sql = "INSERT INTO respostas VALUES (NULL, '$codigoRespostas', '$respostaDada', '$acertou', '$nota', '$id_questao', '$id_prova', '$id_disciplina', '$id_professor')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Dados inseridos com sucesso!</p>";
        echo '<p><a href="../../../servicos_professor/pagina_servicos_professor.php" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Dashboard</a></p>';
    } else {
        
        $erro = $conn->error;
        // Verifica se o erro é de chave estrangeira (MySQL error code 1452)
        if ($conn->errno == 1452) {
          echo "<p style='color: red;'>Erro: Problema com vinculos</p>";
        } elseif (strpos($erro, "Column count doesn't match value count") !== false) {
          echo "<p style='color: orange;'>Erro: Insira primeiro os dados de questão de prova e prova.</p>";
        } else {
            echo "<p>Erro ao inserir dados: " . $erro . "</p>";
        } 
        echo '<p><a href="formRespostas.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';

    }

    $conn->close();

?>



