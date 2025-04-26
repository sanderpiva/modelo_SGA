<?php
include '../conexao.php'; // Inclui o arquivo de conexão

// Verifica se a requisição é POST e se os dados necessários foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_conteudo'])) {

    // Obtém e sanitiza os dados do formulário
    $id_conteudo = mysqli_real_escape_string($conn, $_POST['id_conteudo']);
    $codigoConteudo = mysqli_real_escape_string($conn, $_POST['codigoConteudo']);
    $tituloConteudo = mysqli_real_escape_string($conn, $_POST['tituloConteudo']);
    $descricaoConteudo = mysqli_real_escape_string($conn, $_POST['descricaoConteudo']);
    $data_postagem = mysqli_real_escape_string($conn, $_POST['data_postagem']);
    $professor = mysqli_real_escape_string($conn, $_POST['professor']);
    $disciplina = mysqli_real_escape_string($conn, $_POST['disciplina']);
    $tipo_conteudo = mysqli_real_escape_string($conn, $_POST['tipo_conteudo']);

    // Constrói a query SQL de atualização
    $sql = "UPDATE conteudo SET
                codigoConteudo = '$codigoConteudo',
                titulo = '$tituloConteudo',
                descricao = '$descricaoConteudo',
                data_postagem = '$data_postagem',
                professor = '$professor',
                disciplina = '$disciplina',
                tipo_conteudo = '$tipo_conteudo'
            WHERE id_conteudo = '$id_conteudo'";

    // Executa a query
    if (mysqli_query($conn, $sql)) {
        // Atualização bem-sucedida
        $message = "Conteúdo com código $codigoConteudo atualizado com sucesso!";
        // Redireciona de volta para a página de consulta com uma mensagem de sucesso
        header("Location: consultaConteudo.php?message=" . urlencode($message));
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Erro na atualização
        $error = "Erro ao atualizar conteúdo: " . mysqli_error($conn);
        $pathToForm = '../../cadastros/cadastroConteudo/formConteudo.php'; // Ajuste o caminho conforme a estrutura REAL
        header("Location: " . $pathToForm . "?id_conteudo=" . urlencode($id_conteudo) . "&erros=" . urlencode($error));
        exit();
    }

} else {
    // Requisição inválida (não é POST ou falta id_conteudo)
    $error = "Requisição inválida para atualização de conteúdo.";
    // Redireciona para a página de consulta ou outra página de erro
    header("Location: consultaConteudo.php?erros=" . urlencode($error));
    exit();
}

mysqli_close($conn); // Fecha a conexão
?>