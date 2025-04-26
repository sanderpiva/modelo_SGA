<?php
include '../conexao.php'; // Inclui o arquivo de conexão

// Verifica se a requisição é POST e se os dados necessários foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_prova'])) {

    // Obtém e sanitiza os dados do formulário
    $id_prova = mysqli_real_escape_string($conn, $_POST['id_prova']);
    $codigoProva = mysqli_real_escape_string($conn, $_POST['codigoProva']);
    $tipo_prova = mysqli_real_escape_string($conn, $_POST['tipo_prova']);
    $disciplina = mysqli_real_escape_string($conn, $_POST['disciplina']);
    $conteudo = mysqli_real_escape_string($conn, $_POST['conteudo']);
    $data_prova = mysqli_real_escape_string($conn, $_POST['data_prova']);
    $professor = mysqli_real_escape_string($conn, $_POST['professor']);
    
    // Constrói a query SQL de atualização
    $sql = "UPDATE prova SET
                codigoProva = '$codigoProva',
                tipo_prova = '$tipo_prova',
                disciplina = '$disciplina',
                conteudo = '$conteudo',
                data_prova = '$data_prova',
                professor = '$professor'
            WHERE id_prova = '$id_prova'";

    // Executa a query
    if (mysqli_query($conn, $sql)) {
        // Atualização bem-sucedida
        $message = "Prova com código " . htmlspecialchars($codigoProva) . " atualizada com sucesso!";
        // Redireciona de volta para a página de consulta
        header("Location: consultaProva.php?message=" . urlencode($message));
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Erro na atualização
        $error = "Erro ao atualizar prova: " . mysqli_error($conn);
        $pathToForm = '../../cadastros/cadastroProva/formProva.php';
        header("Location: " . $pathToForm . "?id_prova=" . urlencode($id_prova) . "&erros=" . urlencode($error));
        exit(); // Garante que o script pare após o redirecionamento
    }

} else {
    // Requisição inválida
    $error = "Requisição inválida para atualização de prova.";
    header("Location: consultaProva.php?erros=" . urlencode($error));
    exit();
}

mysqli_close($conn); // Fecha a conexão
?>