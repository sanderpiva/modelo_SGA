<?php
include '../conexao.php'; // Inclui o arquivo de conexão

// Verifica se a requisição é POST e se os dados necessários foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_professor'])) {

    // Obtém e sanitiza os dados do formulário
    $id_professor = mysqli_real_escape_string($conn, $_POST['id_professor']);
    $registroProfessor = mysqli_real_escape_string($conn, $_POST['registroProfessor']);
    $nomeProfessor = mysqli_real_escape_string($conn, $_POST['nomeProfessor']);
    $emailProfessor = mysqli_real_escape_string($conn, $_POST['emailProfessor']);
    $enderecoProfessor = mysqli_real_escape_string($conn, $_POST['enderecoProfessor']);
    $telefoneProfessor = mysqli_real_escape_string($conn, $_POST['telefoneProfessor']);
    
    // Constrói a query SQL de atualização
    $sql = "UPDATE professor SET
                registroProfessor = '$registroProfessor',
                nome = '$nomeProfessor',
                email = '$emailProfessor',
                endereco = '$enderecoProfessor',
                telefone = '$telefoneProfessor'
            WHERE id_professor = '$id_professor'";

    // Executa a query
    if (mysqli_query($conn, $sql)) {
        // Atualização bem-sucedida
        $message = "Professor com registro " . htmlspecialchars($registroProfessor) . " atualizado com sucesso!";
        // Redireciona de volta para a página de consulta
        header("Location: consultaProfessor.php?message=" . urlencode($message));
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Erro na atualização
        $error = "Erro ao atualizar professor: " . mysqli_error($conn);
        $pathToForm = '../../cadastros/cadastroProfessor/formProfessor.php';
        header("Location: " . $pathToForm . "?id_professor=" . urlencode($id_professor) . "&erros=" . urlencode($error));
        exit(); // Garante que o script pare após o redirecionamento
    }

} else {
    // Requisição inválida
    $error = "Requisição inválida para atualização de professor.";
    header("Location: consultaProfessor.php?erros=" . urlencode($error));
    exit();
}

mysqli_close($conn); // Fecha a conexão
?>