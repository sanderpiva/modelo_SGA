<?php

$erros = "";

// Verificação de campos obrigatórios
if (
    empty($_POST["aluno_matricula"])||
    empty($_POST["id_disciplina"]) 
    
) {
    $erros .= "Todos os campos devem ser preenchidos.<br>";
}


if (strlen($_POST["aluno_matricula"]) < 3 || strlen($_POST["aluno_matricula"]) > 20) {
    $erros .= "Erro: campo 'Matrícula do Aluno' deve ter entre 3 e 20 caracteres.<br>";
}

// Validar ID disciplina? Eh uma chave estrangeira!


// Exibe erros ou prossegue com submissão
if (!empty($erros)) {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Erros ao Cadastrar Matrícula</title>
        <meta charset='utf-8'>
        <link rel='stylesheet' href='../../../css/style.css'>
    </head>
    <body class='servicos_forms'>
        <div class='form_container'>
            <h2>Erros ao Cadastrar Matrícula</h2>
            <div style='color: red;'>$erros</div>
            <hr>
            <a href='formMatricula.php'>Voltar ao formulário</a>
        </div>
    </body>
    </html>";
    exit;
} else {
    // Sem erros: gera formulário oculto para submissão
    echo '<form action="inserirMatricula.php" method="POST" name="form_inserir">';
    foreach ($_POST as $key => $value) {
        echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
    }
    echo '</form>';
    echo '<script>document.forms["form_inserir"].submit();</script>';
    exit;
}
?>
