<?php
include '../conexao.php';

if (isset($_GET['id_respostas']) && !empty($_GET['id_respostas'])) {
    $idRespostaExcluir = $_GET['id_respostas'];

    $sql = "DELETE FROM respostas WHERE id_respostas = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $idRespostaExcluir);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>alert('Registro excluído com sucesso!'); window.location.href = 'consultaRespostas.php';</script>";
            } else {
                echo "<script>alert('Nenhum registro foi excluído. Verifique se o código está correto.'); window.location.href = 'consultaRespostas.php';</script>";
            }
        } else {
            // Captura erro específico de violação de chave estrangeira
            $erro = mysqli_error($conn);
            if (strpos($erro, 'foreign key constraint fails') !== false) {
                echo "<script>alert('Erro: nao eh possivel excluir essa resposta pois ha vinculos com outros registros.'); window.location.href = 'consultaRespostas.php';</script>";
            } else {
                echo "<script>alert('Erro ao excluir: " . addslashes($erro) . "'); window.location.href = 'consultaRespostas.php';</script>";
            }
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro na preparação da consulta.'); window.location.href = 'consultaRespostas.php';</script>";
    }
} else {
    echo "<script>alert('Código de resposta inválido para exclusão.'); window.location.href = 'consultaRespostas.php';</script>";
}

mysqli_close($conn);
?>