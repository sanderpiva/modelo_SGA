<?php
    include '../conexao.php';

    if (isset($_GET['id_conteudo']) && !empty($_GET['id_conteudo'])) {
        $idConteudoExcluir = $_GET['id_conteudo'];

        $sql = "DELETE FROM conteudo WHERE id_conteudo = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $idConteudoExcluir); // Usar prepared statement para segurança
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Registro excluído com sucesso!'); window.location.href = 'consultaConteudo.php';</script>";
        } else {
            echo "<script>alert('Erro ao excluir o registro!'); window.location.href = 'consultaConteudo.php';</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('ID do conteúdo inválido para exclusão!'); window.location.href = 'consultaConteudo.php';</script>";
    }

    mysqli_close($conn);
?>