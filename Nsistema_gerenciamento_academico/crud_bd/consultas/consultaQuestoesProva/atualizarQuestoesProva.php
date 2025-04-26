<?php
include '../conexao.php'; // Inclui o arquivo de conexão

// Verifica se a requisição é POST e se os dados necessários foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_questao'])) {

    // Obtém e sanitiza os dados do formulário
    $id_questaoProva = mysqli_real_escape_string($conn, $_POST['id_questao']);
    $codigoQuestaoProva = mysqli_real_escape_string($conn, $_POST['codigoQuestaoProva']); // Nome do campo no formulário
    $descricao_questao_prova = mysqli_real_escape_string($conn, $_POST['descricao_questao']); // Nome do campo no formulário
    $tipo_prova = mysqli_real_escape_string($conn, $_POST['tipo_prova']); // Nome do campo no formulário
    $id_prova = mysqli_real_escape_string($conn, $_POST['id_prova']); // Nome do campo no formulário
    $id_disciplina = mysqli_real_escape_string($conn, $_POST['id_disciplina']);
    $id_professor = mysqli_real_escape_string($conn, $_POST['id_professor']);
    
    // Constrói a query SQL de atualização
    $sql = "UPDATE questoes SET
                codigoQuestao = '$codigoQuestaoProva',
                descricao = '$descricao_questao_prova',
                tipo_prova = '$tipo_prova',
                Prova_id_prova = '$id_prova',
                Prova_Disciplina_id_disciplina = '$id_disciplina',
                Prova_Disciplina_Professor_id_professor = '$id_professor'
            WHERE id_questao = '$id_questaoProva'";

    if (mysqli_query($conn, $sql)) {
        // Atualização bem-sucedida
        $message = "Questão prova com código " . htmlspecialchars($codigoQuestaoProva) . " atualizada com sucesso!";
        // Redireciona de volta para a página de consulta com uma mensagem de sucesso
        header("Location: consultaQuestoesProva.php?message=" . urlencode($message));
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Erro na atualização
        $error = "Erro ao atualizar questão prova: " . mysqli_error($conn);
        $pathToForm = '../../cadastros/cadastroQuestoesProva/formQuestoesProva.php';
        header("Location: " . $pathToForm . "?id_questaoProva=" . urlencode($id_questaoProva) . "&erros=" . urlencode($error));
        exit(); // Garante que o script pare após o redirecionamento
    }

} else {
    // Requisição inválida (não é POST ou falta id_questaoProva)
    $error = "Requisição inválida para atualização de questão prova.";
    header("Location: consultaQuestoesProva.php?erros=" . urlencode($error));
    exit();
}

mysqli_close($conn); // Fecha a conexão
?>