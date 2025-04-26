<?php
include '../conexao.php';

if (isset($_GET['codigoMatricula']) && !empty($_GET['codigoMatricula'])) {
    $codigoMatriculaExcluir = $_GET['codigoMatricula'];

    $sql = "DELETE FROM matricula WHERE aluno_matricula = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $codigoMatriculaExcluir);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>alert('Registro excluído com sucesso!'); window.location.href = 'consultaMatricula.php';</script>";
            } else {
                echo "<script>alert('Nenhum registro foi excluído. Verifique se o código está correto.'); window.location.href = 'consultaMatricula.php';</script>";
            }
        } else {
            // Captura erro específico de violação de chave estrangeira
            $erro = mysqli_error($conn);
            if (strpos($erro, 'foreign key constraint fails') !== false) {
                echo "<script>alert('Erro: nao eh possivel excluir essa matricula pois ha vinculos com outros registros.'); window.location.href = 'consultaMatricula.php';</script>";
            } else {
                echo "<script>alert('Erro ao excluir: " . addslashes($erro) . "'); window.location.href = 'consultaMatricula.php';</script>";
            }
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro na preparação da consulta.'); window.location.href = 'consultaMatricula.php';</script>";
    }
} else {
    echo "<script>alert('Código de turma inválido para exclusão.'); window.location.href = 'consultaMatricula.php';</script>";
}

mysqli_close($conn);
?>
