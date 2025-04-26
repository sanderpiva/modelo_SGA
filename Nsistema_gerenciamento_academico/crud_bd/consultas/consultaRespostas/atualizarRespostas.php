<?php
include '../conexao.php'; // Inclui o arquivo de conexão

// Verifica se a requisição é POST e se os dados necessários foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_respostas'])) {

    // Obtém e sanitiza os dados do formulário
    $id_respostas = mysqli_real_escape_string($conn, $_POST['id_respostas']);
    $codigoRespostas = mysqli_real_escape_string($conn, $_POST['codigoRespostas']);
    $codigoProva = mysqli_real_escape_string($conn, $_POST['codigoProva']);
    $respostaDada = mysqli_real_escape_string($conn, $_POST['respostaDada']);
    $acertou = mysqli_real_escape_string($conn, $_POST['acertou']); // Recebe 0 ou 1 do radio button
    $nota = mysqli_real_escape_string($conn, $_POST['nota']);
    $id_questao = mysqli_real_escape_string($conn, $_POST['id_questao']);
    $id_prova = mysqli_real_escape_string($conn, $_POST['id_prova']);
    $id_disciplina = mysqli_real_escape_string($conn, $_POST['id_disciplina']);
    $id_professor = mysqli_real_escape_string($conn, $_POST['id_professor']);
    // Constrói a query SQL de atualização
    // Usando nomes de colunas como identificamos (codigoRespostas, codigoAluno, codigoProva, respostaDada, acertou, codigoQuestao)
    $sql = "UPDATE respostas SET
                CodigoRespostas = '$codigoRespostas',
                respostaDada = '$respostaDada',
                acertou = '$acertou',
                nota = '$nota'
            WHERE id_respostas = '$id_respostas'";

    // Executa a query
    if (mysqli_query($conn, $sql)) {
        // Atualização bem-sucedida
        $message = "Resposta com código " . htmlspecialchars($codigoRespostas) . " atualizada com sucesso!";
        // Redireciona de volta para a página de consulta com uma mensagem de sucesso
        // Se consultaRespostas.php estiver na mesma pasta que processaAtualizarRespostas.php, o caminho abaixo está correto
        header("Location: consultaRespostas.php?message=" . urlencode($message));
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Erro na atualização

        // Captura a mensagem de erro específica do MySQL
        $error = "Erro ao atualizar resposta: " . mysqli_error($conn);

        // *** REDIRECIONAMENTO EM CASO DE ERRO ***
        // Ajuste o caminho $pathToForm de acordo com a estrutura REAL das suas pastas!
        // Exemplo: Se processaAtualizarRespostas.php estiver em /crud_bd/consultas/consultaRespostas/
        // e formRespostas.php estiver em /crud_bd/cadastros/cadastroRespostas/,
        // o caminho relativo é ../../cadastros/cadastroRespostas/formRespostas.php
        $pathToForm = '../../cadastros/cadastroRespostas/formRespostas.php';
         // *** AJUSTE O VALOR DE $pathToForm ACIMA! ***

        // Redireciona de volta para o formulário de atualização, passando o código
        // e a mensagem de erro na URL
        header("Location: " . $pathToForm . "?id_respostas=" . urlencode($codigoRespostas) . "&erros=" . urlencode($error));
        exit(); // Garante que o script pare após o redirecionamento
    }

} else {
    // Requisição inválida (não é POST ou falta codigoRespostas)
    $error = "Requisição inválida para atualização de resposta.";
    // Redireciona para a página de consulta ou outra página de erro
    // Assumindo que consultaRespostas.php está na mesma pasta para este redirecionamento também
     header("Location: consultaRespostas.php?erros=" . urlencode($error));
     exit();
}

mysqli_close($conn); // Fecha a conexão
?>