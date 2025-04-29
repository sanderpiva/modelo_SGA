<?php

    $codigoDisciplina = $_POST["codigoDisciplina"];
    $nomeDisciplina = $_POST["nomeDisciplina"];
    $carga_horaria = $_POST["carga_horaria"];
    $professor = $_POST["professor"];
    $descricaoDisciplina = $_POST["descricaoDisciplina"];
    $semestre_periodo = $_POST["semestre_periodo"];
    $id_professor = $_POST["Professor_id_professor"];
    $id_turma = $_POST["id_turma"];
    
    //conexao.php
    include '../conexao.php';

    $sql = "INSERT INTO disciplina VALUES (NULL, '$codigoDisciplina', '$nomeDisciplina', '$carga_horaria', '$professor', '$descricaoDisciplina', '$semestre_periodo', '$id_professor', '$id_turma')";

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
        echo '<p><a href="formDisciplina.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';

    }

    $conn->close();

?>



