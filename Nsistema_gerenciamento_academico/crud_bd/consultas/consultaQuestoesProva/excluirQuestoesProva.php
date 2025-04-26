<?php
include '../conexao.php';

if (isset($_GET['id_questaoProva']) && !empty($_GET['id_questaoProva'])) {
    $id_questaoProvaExcluir = $_GET['id_questaoProva'];

    $sql = "DELETE FROM questoes WHERE id_questao = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id_questaoProvaExcluir);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>alert('Registro excluído com sucesso!'); window.location.href = 'consultaQuestoesProva.php';</script>";
            } else {
                echo "<script>alert('Nenhum registro foi excluído. Verifique se o código está correto.'); window.location.href = 'consultaQuestoesProva.php';</script>";
            }
        } else {
            $erro = mysqli_error($conn);
            if (strpos($erro, 'foreign key constraint fails') !== false) {
                echo "<script>alert('Erro: nao eh possivel excluir essa questao de prova pois ha vinculos com outros registros.'); window.location.href = 'consultaQuestoesProva.php';</script>";
            } else {
                echo "<script>alert('Erro ao excluir: " . addslashes($erro) . "'); window.location.href = 'consultaQuestoesProva.php';</script>";
            }
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro na preparação da consulta.'); window.location.href = 'consultaQuestoesProva.php';</script>";
    }
} else {
    echo "<script>alert('Código de questao de prova inválido para exclusão.'); window.location.href = 'consultaQuestoesProva.php';</script>";
}

mysqli_close($conn);
?>