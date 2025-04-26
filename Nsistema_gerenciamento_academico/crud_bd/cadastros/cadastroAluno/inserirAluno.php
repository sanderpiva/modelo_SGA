<?php

    $matricula = $_POST["matricula"];
    $nomeAluno = $_POST["nomeAluno"];
    $cpf = $_POST["cpf"];
    $emailAluno = $_POST["emailAluno"];
    $data_nascimento = $_POST["data_nascimento"];
    $enderecoAluno = $_POST["enderecoAluno"];
    $cidadeAluno = $_POST["cidadeAluno"];
    $telefoneAluno = $_POST["telefoneAluno"];
    $id_turma = $_POST["id_turma"];

    //conexao.php
    include '../conexao.php';

    $sql = "INSERT INTO aluno VALUES (NULL,'$matricula', '$nomeAluno', '$cpf', '$emailAluno', '$data_nascimento', '$enderecoAluno', '$cidadeAluno', '$telefoneAluno', '$id_turma')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Dados inseridos com sucesso!</p>";
        echo '<p><a href="../../../servicos_professor/pagina_servicos_professor.php" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Dashboard</a></p>';
    } else {
        echo "<p>Erro ao inserir dados: " . $conn->error . "</p>";
        echo '<p><a href="formAluno.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';
    }

    $conn->close();

?>