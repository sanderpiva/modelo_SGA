<?php
require_once '../conexao.php';

$disciplinas = $conexao->query("SELECT * FROM disciplina")->fetchAll(PDO::FETCH_ASSOC);
$professores = $conexao->query("SELECT * FROM professor")->fetchAll(PDO::FETCH_ASSOC);
$provas = $conexao->query("SELECT * FROM prova")->fetchAll(PDO::FETCH_ASSOC);

$isUpdating = false;
$questaoProvaData = [];
$errors = "";
$nomeDisciplinaAtual = '';
$registroProfessorAtual = '';
$nomeProvaAtual = '';

if (isset($_GET['id_questaoProva']) && !empty($_GET['id_questaoProva'])) {
    $isUpdating = true;
    $idQuestaoToUpdate = filter_input(INPUT_GET, 'id_questaoProva', FILTER_SANITIZE_NUMBER_INT);

    if ($idQuestaoToUpdate === false || $idQuestaoToUpdate === null) {
        $errors = "<p style='color:red;'>ID da questão inválido.</p>";
        $isUpdating = false;
    } else {
        $stmt = $conexao->prepare("SELECT * FROM questoes WHERE id_questao = :id");
        $stmt->execute([':id' => $idQuestaoToUpdate]);
        $questaoProvaData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$questaoProvaData) {
            $errors = "<p style='color:red;'>Questão com ID " . htmlspecialchars($idQuestaoToUpdate) . " não encontrada.</p>";
            $isUpdating = false;
        } else {

            foreach ($disciplinas as $disciplina) {
                if ($disciplina['id_disciplina'] == $questaoProvaData['Prova_Disciplina_id_disciplina']) {
                    $nomeDisciplinaAtual = $disciplina['nome'];
                    break;
                }
            }
            foreach ($professores as $professor) {
                if ($professor['id_professor'] == $questaoProvaData['Prova_Disciplina_Professor_id_professor']) {
                    $registroProfessorAtual = $professor['registroProfessor'];
                    break;
                }
            }
            foreach ($provas as $prova) {
                if ($prova['id_prova'] == $questaoProvaData['Prova_id_prova']) {
                    $nomeProvaAtual = $prova['codigoProva'];
                    break;
                }
            }
        }
    }
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

            <?php if ($isUpdating): ?>
                <label for="id_prova">Prova:</label>
                <input type="text" value="<?php echo htmlspecialchars($nomeProvaAtual); ?>" readonly required>
                <input type="hidden" name="id_prova" value="<?php echo htmlspecialchars($questaoProvaData['Prova_id_prova'] ?? ''); ?>">
                <hr>
            <?php else: ?>
                <label for="id_prova">Prova:</label>
                <select name="id_prova" required>
                    <option value="">Selecione codigo de prova</option>
                    <?php foreach ($provas as $prova): ?>
                        <option value="<?= $prova['id_prova'] ?>"><?= htmlspecialchars($prova['codigoProva']) ?></option>
                    <?php endforeach; ?>
                </select>
                <hr>
            <?php endif; ?>

            <?php if ($isUpdating): ?>
                <label for="id_disciplina">Disciplina:</label>
                <input type="text" value="<?php echo htmlspecialchars($nomeDisciplinaAtual); ?>" readonly required>
                <input type="hidden" name="id_disciplina" value="<?php echo htmlspecialchars($questaoProvaData['Prova_Disciplina_id_disciplina'] ?? ''); ?>">
                <hr>
            <?php else: ?>
                <label for="id_disciplina">Disciplina:</label>
                <select name="id_disciplina" required>
                    <option value="">Selecione uma disciplina</option>
                    <?php foreach ($disciplinas as $disciplina): ?>
                        <option value="<?= $disciplina['id_disciplina'] ?>"><?= htmlspecialchars($disciplina['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
                <hr>
            <?php endif; ?>

            <?php if ($isUpdating): ?>
                <label for="id_professor">Nome Professor:</label>
                <input type="text" value="<?php echo htmlspecialchars($registroProfessorAtual); ?>" readonly required>
                <input type="hidden" name="id_professor" value="<?php echo htmlspecialchars($questaoProvaData['Prova_Disciplina_Professor_id_professor'] ?? ''); ?>">
                <hr>
            <?php else: ?>
                <label for="id_professor">Nome Professor:</label>
                <select name="id_professor" required>
                    <option value="">Selecione um professor</option>
                    <?php foreach ($professores as $professor): ?>
                        <option value="<?= $professor['id_professor'] ?>"><?= htmlspecialchars($professor['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
                <hr>
            <?php endif; ?>

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