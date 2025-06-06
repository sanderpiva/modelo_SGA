<?php
require_once '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_aluno = $_POST['id_aluno'];
    $matricula = $_POST['matricula'];
    $nomeAluno = $_POST['nomeAluno'];
    $cpf = $_POST['cpf'];
    $emailAluno = $_POST['emailAluno'];
    $data_nascimento = $_POST['data_nascimento'];
    $enderecoAluno = $_POST['enderecoAluno'];
    $cidadeAluno = $_POST['cidadeAluno'];
    $telefoneAluno = $_POST['telefoneAluno'];

    $stmt = $conexao->prepare("UPDATE aluno SET
        matricula = :matricula,
        nome = :nome,
        cpf = :cpf,
        email = :email,
        data_nascimento = :data_nascimento,
        endereco = :endereco,
        cidade = :cidade,
        telefone = :telefone
        WHERE id_aluno = :id");

    $stmt->execute([
        ':matricula' => $matricula,
        ':nome' => $nomeAluno,
        ':cpf' => $cpf,
        ':email' => $emailAluno,
        ':data_nascimento' => $data_nascimento,
        ':endereco' => $enderecoAluno,
        ':cidade' => $cidadeAluno,
        ':telefone' => $telefoneAluno,
        ':id' => $id_aluno
    ]);

    header("Location: ../../consultas/consultaAluno/consultaAluno.php?atualizado=sucesso");
    exit;
}
?>