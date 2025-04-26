<?php
include '../conexao.php';

if (isset($_GET['id_professor']) && !empty($_GET['id_professor'])) {
    $id_professorExcluir = $_GET['id_professor'];

    $sql = "DELETE FROM professor WHERE id_professor = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id_professorExcluir);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>alert('Registro excluído com sucesso!'); window.location.href = 'consultaProfessor.php';</script>";
            } else {
                echo "<script>alert('Nenhum registro foi excluído. Verifique se o código está correto.'); window.location.href = 'consultaProfessor.php';</script>";
            }
        } else {
            $erro = mysqli_error($conn);
            if (strpos($erro, 'foreign key constraint fails') !== false) {
                echo "<script>alert('Erro: não é possível excluir esse professor pois há vínculos com outros registros.'); window.location.href = 'consultaProfessor.php';</script>";
            } else {
                echo "<script>alert('Erro ao excluir: " . addslashes($erro) . "'); window.location.href = 'consultaProfessor.php';</script>";
            }
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro na preparação da consulta.'); window.location.href = 'consultaProfessor.php';</script>";
    }
} else {
    echo "<script>alert('Código de professor inválido para exclusão.'); window.location.href = 'consultaProfessor.php';</script>";
}

mysqli_close($conn);
?>