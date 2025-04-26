<?php
include '../conexao.php';

if (isset($_GET['id_disciplina']) && !empty($_GET['id_disciplina'])) {
    $id_disciplinaExcluir = $_GET['id_disciplina'];

    $sql = "DELETE FROM disciplina WHERE id_disciplina = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id_disciplinaExcluir);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>alert('Registro excluído com sucesso!'); window.location.href = 'consultaDisciplina.php';</script>";
            } else {
                echo "<script>alert('Nenhum registro foi excluído. Verifique se o código está correto.'); window.location.href = 'consultaDisciplina.php';</script>";
            }
        } else {
            $erro = mysqli_error($conn);
            if (strpos($erro, 'foreign key constraint fails') !== false) {
                echo "<script>alert('Erro: não é possível excluir essa disciplina pois há registros dependentes (como turmas ou matrículas).'); window.location.href = 'consultaDisciplina.php';</script>";
            } else {
                echo "<script>alert('Erro ao excluir: " . addslashes($erro) . "'); window.location.href = 'consultaDisciplina.php';</script>";
            }
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro na preparação da consulta.'); window.location.href = 'consultaDisciplina.php';</script>";
    }
} else {
    echo "<script>alert('ID de disciplina inválido para exclusão.'); window.location.href = 'consultaDisciplina.php';</script>";
}

mysqli_close($conn);
?>