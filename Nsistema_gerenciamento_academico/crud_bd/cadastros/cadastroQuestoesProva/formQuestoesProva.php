<?php
require_once '../conexao.php';

$isUpdating = false;
$questaoProvaData = []; // Array para armazenar os dados da questão em caso de atualização
$errors = "";

// Verifica se um ID de questão foi passado na URL (modo de atualização)
if (isset($_GET['id_questaoProva']) && !empty($_GET['id_questaoProva'])) {
    $isUpdating = true;
    $idQuestaoToUpdate = $_GET['id_questaoProva'];

    $stmt = $conexao->prepare("SELECT * FROM questoes WHERE id_questao = :id");
    $stmt->execute([':id' => $idQuestaoToUpdate]);
    $questaoProvaData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$questaoProvaData) {
        $errors = "<p style='color:red;'>Questão com ID " . htmlspecialchars($idQuestaoToUpdate) . " não encontrada.</p>";
        $isUpdating = false;
    }
} else {
    $errors = "<p style='color:red;'>ID da questão não fornecido.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Questão Prova</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">
        <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaQuestoesProva/atualizarQuestoesProva.php' : 'validaInserirQuestaoProva.php'; ?>" method="post">
            <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Questão Prova</h2>
            <hr>

            <label for="codigoQuestaoProva">Codigo Questao:</label>
            <?php if ($isUpdating): ?>
                <input type="text" name="codigoQuestaoProva" id="codigoQuestaoProva" placeholder="Digite codigo questao" value="<?php echo htmlspecialchars($questaoProvaData['codigoQuestao'] ?? ''); ?>" required>
                <input type="hidden" name="id_questao" value="<?php echo htmlspecialchars($questaoProvaData['id_questao'] ?? ''); ?>">
            <?php else: ?>
                <input type="text" name="codigoQuestaoProva" id="codigoQuestaoProva" placeholder="Digite codigo questao" required>
            <?php endif; ?>
            <hr>

            <label for="descricao_questao">Descricao prova:</label>
            <input type="text" name="descricao_questao" id="descricao_questao" placeholder="Descricao prova" value="<?php echo htmlspecialchars($questaoProvaData['descricao'] ?? ''); ?>" required>
            <hr>

            <label for="tipo_prova">Tipo prova:</label>
            <input type="text" name="tipo_prova" id="tipo_prova" placeholder="Digite tipo prova" value="<?php echo htmlspecialchars($questaoProvaData['tipo_prova'] ?? ''); ?>" required>
            <hr>

            <label for="id_prova">ID prova:</label>
            <input type="text" name="id_prova" id="id_prova" placeholder="ID prova" value="<?php echo htmlspecialchars($questaoProvaData['Prova_id_prova'] ?? ''); ?>" required>
            <hr>

            <label for="id_disciplina">ID disciplina:</label>
            <input type="text" name="id_disciplina" id="id_disciplina" placeholder="ID disciplina" value="<?php echo htmlspecialchars($questaoProvaData['Prova_Disciplina_id_disciplina'] ?? ''); ?>" required>
            <hr>

            <label for="id_professor">ID professor:</label>
            <input type="text" name="id_professor" id="id_professor" placeholder="ID professor" value="<?php echo htmlspecialchars($questaoProvaData['Prova_Disciplina_Professor_id_professor'] ?? ''); ?>" required>
            <hr>

            <button type="submit"><?php echo $isUpdating ? 'Atualizar' : 'Cadastrar'; ?></button>
        </form>

        <?php echo $errors; ?>
        <hr>
    </div>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>
    <hr>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>