<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_aluno = mysqli_real_escape_string($conn, $_POST['id_aluno']);
    $matricula = mysqli_real_escape_string($conn, $_POST['matricula']); // Recebe a matrícula (não será usada para UPDATE WHERE)
    $nomeAluno = mysqli_real_escape_string($conn, $_POST['nomeAluno']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $emailAluno = mysqli_real_escape_string($conn, $_POST['emailAluno']);
    $data_nascimento = mysqli_real_escape_string($conn, $_POST['data_nascimento']);
    $enderecoAluno = mysqli_real_escape_string($conn, $_POST['enderecoAluno']);
    $cidadeAluno = mysqli_real_escape_string($conn, $_POST['cidadeAluno']);
    $telefoneAluno = mysqli_real_escape_string($conn, $_POST['telefoneAluno']);

    $sql = "UPDATE aluno SET
            matricula = '$matricula',
            nome = '$nomeAluno',
            cpf = '$cpf',
            email = '$emailAluno',
            data_nascimento = '$data_nascimento',
            endereco = '$enderecoAluno',
            cidade = '$cidadeAluno',
            telefone = '$telefoneAluno'
            WHERE id_aluno = '$id_aluno'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../../consultas/consultaAluno/consultaAluno.php?atualizado=sucesso");
    } else {
        echo "Erro ao atualizar o aluno: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>