<?php
include '../conexao.php';

if (isset($_GET['id_aluno']) && !empty($_GET['id_aluno'])) {
    $id_aluno = mysqli_real_escape_string($conn, $_GET['id_aluno']);

    $sql = "DELETE FROM aluno WHERE id_aluno = '$id_aluno'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../../consultas/consultaAluno/consultaAluno.php?excluido=sucesso");
    } else {
        echo "Erro ao excluir o aluno: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "ID do aluno não especificado para exclusão.";
}
?>