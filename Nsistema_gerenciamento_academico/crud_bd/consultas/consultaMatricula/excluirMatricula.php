
<?php
require_once "../conexao.php";
// Matricula vai ter um ID soh dela? Eh tabela intermediaria!
if (isset($_GET['codigoMatricula']) && !empty($_GET['codigoMatricula'])) {
    $codigoMatriculaExcluir = $_GET['codigoMatricula'];

    $stmt = $conexao->prepare("DELETE FROM matricula WHERE aluno_matricula = :codigo");
    $stmt->bindParam(':codigo', $codigoMatriculaExcluir, PDO::PARAM_STR); // Assumindo que codigoMatricula é string

    try {
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                header("Location: consultaMatricula.php?excluido=sucesso");
                exit;
            } else {
                header("Location: consultaMatricula.php?excluido=nenhum");
                exit;
            }
        } else {
            header("Location: consultaMatricula.php?excluido=erro");
            exit;
        }
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
            header("Location: consultaMatricula.php?excluido=dependencia");
            exit;
        } else {
            header("Location: consultaMatricula.php?excluido=erro_sql&erro=" . urlencode($e->getMessage()));
            exit;
        }
    }
} else {
    header("Location: consultaMatricula.php?excluido=codigo_invalido");
    exit;
}
?>