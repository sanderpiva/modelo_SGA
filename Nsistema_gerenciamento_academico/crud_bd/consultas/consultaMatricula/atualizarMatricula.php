<?php
include '../conexao.php'; // Inclui o arquivo de conexão

// Verifica se a requisição é POST e se os dados necessários foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST['original_id_aluno']) &&
    isset($_POST['original_id_disciplina']) &&
    isset($_POST['aluno_matricula']) &&
    isset($_POST['disciplina_id'])) {

    // Obtém e sanitiza os dados originais (para a cláusula WHERE)
    $original_id_aluno = mysqli_real_escape_string($conn, $_POST['original_id_aluno']);
    $original_id_disciplina = mysqli_real_escape_string($conn, $_POST['original_id_disciplina']);

    // Obtém e sanitiza os dados modificados
    $modificado_id_aluno = mysqli_real_escape_string($conn, $_POST['aluno_matricula']);
    $modificado_id_disciplina = mysqli_real_escape_string($conn, $_POST['disciplina_id']);

    // Constrói a query SQL de atualização
    $sql = "UPDATE matricula SET
            Aluno_id_aluno = '$modificado_id_aluno',
            Disciplina_id_disciplina = '$modificado_id_disciplina'
            WHERE Aluno_id_aluno = '$original_id_aluno'
            AND Disciplina_id_disciplina = '$original_id_disciplina'";

    if (mysqli_query($conn, $sql)) {
        // Atualização bem-sucedida
        $message = "Matrícula do Aluno ID " . htmlspecialchars($modificado_id_aluno) .
                   " na Disciplina ID " . htmlspecialchars($modificado_id_disciplina) . " atualizada com sucesso!";
        // Redireciona de volta para a página de consulta com uma mensagem de sucesso
        header("Location: consultaMatricula.php?message=" . urlencode($message));
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Erro na atualização
        $error = "Erro ao atualizar matrícula: " . mysqli_error($conn);
        $pathToForm = '../../cadastros/cadastroMatricula/formMatricula.php';
        header("Location: " . $pathToForm . "?id_aluno=" . urlencode($original_id_aluno) .
               "&id_disciplina=" . urlencode($original_id_disciplina) . "&erros=" . urlencode($error));
        exit(); // Garante que o script pare após o redirecionamento
    }

} else {
    // Requisição inválida (não é POST ou falta algum dos campos)
    $error = "Requisição inválida para atualização de matrícula. Faltam dados do formulário.";
    header("Location: consultaMatricula.php?erros=" . urlencode($error));
    exit();
}

mysqli_close($conn); // Fecha a conexão
?>