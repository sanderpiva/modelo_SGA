<?php
require_once "../conexao.php";

if (isset($_GET['id_resposta']) && !empty($_GET['id_resposta'])) {
    $idRespostaExcluir = $_GET['id_resposta'];

    $stmt = $conexao->prepare("DELETE FROM respostas WHERE id_respostas = :id");
    $stmt->bindParam(':id', $idRespostaExcluir, PDO::PARAM_INT); // Assumindo que id_respostas é um inteiro

    try {
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                header("Location: consultaRespostas.php?excluido=sucesso");
                exit;
            } else {
                header("Location: consultaRespostas.php?excluido=nenhum");
                exit;
            }
        } else {
            header("Location: consultaRespostas.php?excluido=erro");
            exit;
        }
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
            header("Location: consultaRespostas.php?excluido=dependencia");
            exit;
        } else {
            header("Location: consultaRespostas.php?excluido=erro_sql&erro=" . urlencode($e->getMessage()));
            exit;
        }
    }
} else {
    header("Location: consultaRespostas.php?excluido=id_invalido");
    exit;
}
?>