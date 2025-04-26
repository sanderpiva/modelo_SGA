<?php
include '../conexao.php';

if (isset($_GET['id_prova']) && !empty($_GET['id_prova'])) {
    $id_provaExcluir = $_GET['id_prova'];

    $sql = "DELETE FROM prova WHERE id_prova = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id_provaExcluir);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>alert('Registro excluído com sucesso!'); window.location.href = 'consultaProva.php';</script>";
            } else {
                echo "<script>alert('Nenhum registro foi excluído. Verifique se o código está correto.'); window.location.href = 'consultaProva.php';</script>";
            }
        } else {
            $erro = mysqli_error($conn);
            if (strpos($erro, 'foreign key constraint fails') !== false) {
                echo "<script>alert('Erro: não é possível excluir essa prova pois há vínculos com outros registros.'); window.location.href = 'consultaProva.php';</script>";
            } else {
                echo "<script>alert('Erro ao excluir: " . addslashes($erro) . "'); window.location.href = 'consultaProva.php';</script>";
            }
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro na preparação da consulta.'); window.location.href = 'consultaProva.php';</script>";
    }
} else {
    echo "<script>alert('Código de prova inválido para exclusão.'); window.location.href = 'consultaProva.php';</script>";
}

mysqli_close($conn);
?>