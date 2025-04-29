<?php

    $aluno_matricula = $_POST["aluno_matricula"];
    $id_disciplina = $_POST["id_disciplina"];
    
    //conexao.php
    include '../conexao.php';

    $sql = "INSERT INTO matricula VALUES (NULL, '$aluno_matricula', '$id_disciplina')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Dados inseridos com sucesso!</p>";
        echo '<p><a href="../../../servicos_professor/pagina_servicos_professor.php" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Dashboard</a></p>';
    } else {
        
        $erro = $conn->error;
        // Verifica se o erro é de chave estrangeira (MySQL error code 1452)
        if ($conn->errno == 1452) {
          echo "<p style='color: red;'>Erro: Problema com vinculos</p>";
        } elseif (strpos($erro, "Column count doesn't match value count") !== false) {
          echo "<p style='color: orange;'>Erro: Insira primeiro aluno, disciplina, professor</p>";
        } else {
            echo "<p>Erro ao inserir dados: " . $erro . "</p>";
        } 
        echo '<p><a href="formMatricula.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';

    }

    $conn->close();

?>



