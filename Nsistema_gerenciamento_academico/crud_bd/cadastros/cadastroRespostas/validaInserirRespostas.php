<?php
$erros = "";

// Verificação de campos obrigatórios
if (
    empty($_POST["codigoRespostas"]) ||
    empty($_POST["respostaDada"]) ||
    empty($_POST["nota"])||
    empty($_POST["id_questao"]) ||
    empty($_POST["id_prova"]) ||
    empty($_POST["id_disciplina"]) ||
    empty($_POST["id_professor"])
) {
    $erros .= "Todos os campos devem ser preenchidos.<br>";
}

// Validações individuais
if (strlen($_POST["codigoRespostas"]) < 3 || strlen($_POST["codigoRespostas"]) > 20) {
    $erros .= "Erro: campo 'Código da Resposta' deve ter entre 3 e 20 caracteres.<br>";
}

if (strlen($_POST["respostaDada"]) < 1 || strlen($_POST["respostaDada"]) > 500) {
    $erros .= "Erro: campo 'Resposta Dada' deve ter entre 1 e 500 caracteres.<br>";
}

if (!is_numeric($_POST["nota"]) || $_POST["nota"] < 0 || $_POST["nota"] > 1) {
    $erros .= "Erro: campo 'Nota' deve ser um número entre 0 e 1.<br>";
}

if (!is_numeric($_POST["id_questao"]) || $_POST["id_questao"] <= 0) {
    $erros .= "Erro: campo 'ID Questão' deve ser um número positivo.<br>";
}

if (!is_numeric($_POST["id_prova"]) || $_POST["id_prova"] <= 0) {
    $erros .= "Erro: campo 'ID Prova' deve ser um número positivo.<br>";
}

if (!is_numeric($_POST["id_disciplina"]) || $_POST["id_disciplina"] <= 0) {
    $erros .= "Erro: campo 'ID Disciplina' deve ser um número positivo.<br>";
}   

// Exibe erros ou prossegue com submissão
if (!empty($erros)) {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Erros ao Cadastrar Resposta</title>
        <meta charset='utf-8'>
        <link rel='stylesheet' href='../../../css/style.css'>
    </head>
    <body class='servicos_forms'>
        <div class='form_container'>
            <h2>Erros ao Cadastrar Resposta</h2>
            <div style='color: red;'>$erros</div>
            <hr>
            <a href='formRespostas.php'>Voltar ao formulário</a>
        </div>
    </body>
    </html>";
    exit;
} else {
    // Sem erros: gera formulário oculto para submissão
    echo '<form action="inserirRespostas.php" method="POST" name="form_inserir">';
    foreach ($_POST as $key => $value) {
        echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
    }
    echo '</form>';
    echo '<script>document.forms["form_inserir"].submit();</script>';
    exit;
}
?>
