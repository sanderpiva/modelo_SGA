<?php
include '../conexao.php'; // Inclui o arquivo de conexão

// Verifica se a requisição é POST e se os dados necessários foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_disciplina'])) {

    // Obtém e sanitiza os dados do formulário
    $id_disciplina = mysqli_real_escape_string($conn, $_POST['id_disciplina']);
    $codigoDisciplina = mysqli_real_escape_string($conn, $_POST['codigoDisciplina']);
    $nomeDisciplina = mysqli_real_escape_string($conn, $_POST['nomeDisciplina']);
    $carga_horaria = mysqli_real_escape_string($conn, $_POST['carga_horaria']);
    $professor = mysqli_real_escape_string($conn, $_POST['professor']);
    $descricaoDisciplina = mysqli_real_escape_string($conn, $_POST['descricaoDisciplina']);
    $semestre_periodo = mysqli_real_escape_string($conn, $_POST['semestre_periodo']);
    $id_turma = mysqli_real_escape_string($conn, $_POST['id_turma']);
    // Constrói a query SQL de atualização (apenas as colunas que podem ser alteradas)
    $sql = "UPDATE disciplina SET
                codigoDisciplina = '$codigoDisciplina',
                nome = '$nomeDisciplina',
                carga_horaria = '$carga_horaria',
                professor = '$professor',
                descricao = '$descricaoDisciplina',
                semestre_periodo = '$semestre_periodo',
                Turma_id_turma = '$id_turma'
            WHERE id_disciplina = '$id_disciplina'"; // Ou WHERE id = '$id_disciplina'

    // Executa a query
    if (mysqli_query($conn, $sql)) {
        // Atualização bem-sucedida
        $message = "Disciplina com ID " . htmlspecialchars($id_disciplina) . " atualizada com sucesso!";
        // Redireciona de volta para a página de consulta
        header("Location: consultaDisciplina.php?message=" . urlencode($message));
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Erro na atualização
        $error = "Erro ao atualizar disciplina: " . mysqli_error($conn);
        $pathToForm = '../../cadastros/cadastroDisciplina/formDisciplina.php';
        header("Location: " . $pathToForm . "?id_disciplina=" . urlencode($id_disciplina) . "&erros=" . urlencode($error));
        exit(); // Garante que o script pare após o redirecionamento
    }

} else {
    // Requisição inválida
    $error = "Requisição inválida para atualização de disciplina.";
    header("Location: consultaDisciplina.php?erros=" . urlencode($error));
    exit();
}

mysqli_close($conn); // Fecha a conexão
?>