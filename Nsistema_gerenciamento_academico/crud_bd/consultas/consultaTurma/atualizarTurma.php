<?php
include '../conexao.php'; // Inclui o arquivo de conexão

// Verifica se a requisição é POST e se os dados necessários foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_turma'])) {

    // Obtém e sanitiza os dados do formulário
    $id_turma = mysqli_real_escape_string($conn, $_POST['id_turma']);
    $codigoTurma = mysqli_real_escape_string($conn, $_POST['codigoTurma']);
    $nomeTurma = mysqli_real_escape_string($conn, $_POST['nomeTurma']);
    // Constrói a query SQL de atualização
    // Usando o codigoTurma na cláusula WHERE para identificar o registro a ser atualizado
    $sql = "UPDATE turma SET
                codigoTurma = '$codigoTurma',
                nomeTurma = '$nomeTurma'
              WHERE id_turma = '$id_turma'";

    // Executa a query
    if (mysqli_query($conn, $sql)) {
        // Atualização bem-sucedida
        $message = "Turma com código " . htmlspecialchars($codigoTurma) . " atualizada com sucesso!";
        // Redireciona de volta para a página de consulta com uma mensagem de sucesso
        // Se consultaTurma.php estiver na mesma pasta que processaAtualizarTurma.php, o caminho abaixo está correto
        header("Location: consultaTurma.php?message=" . urlencode($message));
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Erro na atualização

        // Captura a mensagem de erro específica do MySQL
        $error = "Erro ao atualizar turma: " . mysqli_error($conn);

        // *** REDIRECIONAMENTO EM CASO DE ERRO ***
        // Ajuste o caminho $pathToForm de acordo com a estrutura REAL das suas pastas!
        // Exemplo: Se processaAtualizarTurma.php estiver em /crud_bd/consultas/consultaTurma/
        // e formTurma.php estiver em /crud_bd/cadastros/cadastroTurma/,
        // o caminho relativo é ../../cadastros/cadastroTurma/formTurma.php
        $pathToForm = '../../cadastros/cadastroTurma/formTurma.php';
         // *** AJUSTE O VALOR DE $pathToForm ACIMA! ***

        // Redireciona de volta para o formulário de atualização, passando o ID da turma
        // e a mensagem de erro na URL
        header("Location: " . $pathToForm . "?id_turma=" . urlencode($_POST['id_turma']) . "&erros=" . urlencode($error));
        exit(); // Garante que o script pare após o redirecionamento
    }

} else {
    // Requisição inválida (não é POST ou falta id_turma)
    $error = "Requisição inválida para atualização de turma.";
    // Redireciona para a página de consulta ou outra página de erro
    // Assumindo que consultaTurma.php está na mesma pasta para este redirecionamento também
     header("Location: consultaTurma.php?erros=" . urlencode($error));
     exit();
}

mysqli_close($conn); // Fecha a conexão
?>