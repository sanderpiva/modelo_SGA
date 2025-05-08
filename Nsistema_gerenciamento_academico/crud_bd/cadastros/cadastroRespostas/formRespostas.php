<?php
require_once '../conexao.php';

$disciplinas = $conexao->query("SELECT * FROM disciplina")->fetchAll(PDO::FETCH_ASSOC);
$professores = $conexao->query("SELECT * FROM professor")->fetchAll(PDO::FETCH_ASSOC);
$provas = $conexao->query("SELECT * FROM prova")->fetchAll(PDO::FETCH_ASSOC);
$questoes = $conexao->query("SELECT * FROM questoes")->fetchAll(PDO::FETCH_ASSOC);

$isUpdating = false;
$respostaData = [];
$errors = "";
$nomeQuestaoAtual = '';
$codigoProvaAtual = '';
$nomeDisciplinaAtual = '';
$registroProfessorAtual = '';

if (isset($_GET['id_resposta']) && !empty($_GET['id_resposta'])) {
    $isUpdating = true;
    $idRespostaToUpdate = filter_input(INPUT_GET, 'id_resposta', FILTER_SANITIZE_NUMBER_INT);

    if ($idRespostaToUpdate === false || $idRespostaToUpdate === null) {
        $errors = "<p style='color:red;'>ID de resposta inválido.</p>";
        $isUpdating = false;
    } else {
        $stmt = $conexao->prepare("SELECT * FROM respostas WHERE id_respostas = :id");
        $stmt->execute([':id' => $idRespostaToUpdate]);
        $respostaData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$respostaData) {
            $errors = "<p style='color:red;'>Resposta com ID " . htmlspecialchars($idRespostaToUpdate) . " não encontrada.</p>";
            $isUpdating = false;
        } else {

            $questaoStmt = $conexao->prepare("SELECT descricao FROM questoes WHERE id_questao = :id");
            $questaoStmt->execute([':id' => $respostaData['Questoes_id_questao']]);
            $questao = $questaoStmt->fetch(PDO::FETCH_ASSOC);
            $nomeQuestaoAtual = htmlspecialchars($questao['descricao'] ?? '');

            $provaStmt = $conexao->prepare("SELECT codigoProva FROM prova WHERE id_prova = :id");
            $provaStmt->execute([':id' => $respostaData['Questoes_Prova_id_prova']]);
            $prova = $provaStmt->fetch(PDO::FETCH_ASSOC);
            $codigoProvaAtual = htmlspecialchars($prova['codigoProva'] ?? '');

            $disciplinaStmt = $conexao->prepare("SELECT nome FROM disciplina WHERE id_disciplina = :id");
            $disciplinaStmt->execute([':id' => $respostaData['Questoes_Prova_Disciplina_id_disciplina']]);
            $disciplina = $disciplinaStmt->fetch(PDO::FETCH_ASSOC);
            $nomeDisciplinaAtual = htmlspecialchars($disciplina['nome'] ?? '');

            $professorStmt = $conexao->prepare("SELECT registroProfessor FROM professor WHERE id_professor = :id");
            $professorStmt->execute([':id' => $respostaData['Questoes_Prova_Disciplina_Professor_id_professor']]);
            $professor = $professorStmt->fetch(PDO::FETCH_ASSOC);
            $registroProfessorAtual = htmlspecialchars($professor['registroProfessor'] ?? '');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Respostas</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">
        <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaRespostas/atualizarRespostas.php' : 'validaInserirRespostas.php'; ?>" method="post">
            <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Respostas</h2>
            <hr>

            <label for="codigoRespostas">Código Respostas:</label>
            <?php if ($isUpdating): ?>
                <input type="text" name="codigoRespostas" id="codigoRespostas" placeholder="" value="<?php echo htmlspecialchars($respostaData['codigoRespostas'] ?? ''); ?>" required>
                <input type="hidden" name="id_respostas" value="<?php echo htmlspecialchars($respostaData['id_respostas'] ?? ''); ?>">
            <?php else: ?>
                <input type="text" name="codigoRespostas" id="codigoRespostas" placeholder="" required>
            <?php endif; ?>
            <hr>

            <label for="respostaDada">Resposta Dada:</label>
            <input type="text" name="respostaDada" id="respostaDada" placeholder="" value="<?php echo htmlspecialchars($respostaData['respostaDada'] ?? ''); ?>" required>
            <hr>

            <label>Acertou?</label>
            <div>
                <input type="radio" id="acertouSim" name="acertou" value="1" <?php echo ($isUpdating && isset($respostaData['acertou']) && $respostaData['acertou'] == 1) ? 'checked' : ''; ?> required>
                <label for="acertouSim">Sim</label>
                <input type="radio" id="acertouNao" name="acertou" value="0" <?php echo ($isUpdating && isset($respostaData['acertou']) && $respostaData['acertou'] == 0) ? 'checked' : ''; ?> required>
                <label for="acertouNao">Não</label>
            </div>
            <hr>

            <label for="nota">Nota:</label>
            <input type="text" name="nota" id="nota" placeholder="" value="<?php echo htmlspecialchars($respostaData['nota'] ?? ''); ?>" required>
            <hr>

            <label for="id_questao">Descrição da Questão:</label>
            <?php if ($isUpdating): ?>
                <input type="text" value="<?php echo $nomeQuestaoAtual; ?>" readonly required>
                <input type="hidden" name="id_questao" value="<?php echo htmlspecialchars($respostaData['Questoes_id_questao'] ?? ''); ?>">
            <?php else: ?>
                <select name="id_questao" id="id_questao" required>
                    <option value="">Selecione a descrição da questão</option>
                    <?php foreach ($questoes as $questao): ?>
                        <option value="<?= htmlspecialchars($questao['id_questao']) ?>"><?= htmlspecialchars($questao['descricao']) ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <hr>

            <label for="id_prova">Prova:</label>
            <?php if ($isUpdating): ?>
                <input type="text" value="<?php echo $codigoProvaAtual; ?>" readonly required>
                <input type="hidden" name="id_prova" value="<?php echo htmlspecialchars($respostaData['Questoes_Prova_id_prova'] ?? ''); ?>">
            <?php else: ?>
                <select name="id_prova" id="id_prova" required>
                    <option value="">Selecione uma prova</option>
                    <?php foreach ($provas as $prova): ?>
                        <option value="<?= htmlspecialchars($prova['id_prova']) ?>"><?= htmlspecialchars($prova['codigoProva']) ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <hr>

            <label for="id_disciplina">Disciplina:</label>
            <?php if ($isUpdating): ?>
                <input type="text" value="<?php echo $nomeDisciplinaAtual; ?>" readonly required>
                <input type="hidden" name="id_disciplina" value="<?php echo htmlspecialchars($respostaData['Questoes_Prova_Disciplina_id_disciplina'] ?? ''); ?>">
            <?php else: ?>
                <select name="id_disciplina" id="id_disciplina" required>
                    <option value="">Selecione uma disciplina</option>
                    <?php foreach ($disciplinas as $disciplina): ?>
                        <option value="<?= htmlspecialchars($disciplina['id_disciplina']) ?>"><?= htmlspecialchars($disciplina['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <hr>

            <label for="id_professor">Professor:</label>
            <?php if ($isUpdating): ?>
                <input type="text" value="<?php echo $registroProfessorAtual; ?>" readonly required>
                <input type="hidden" name="id_professor" value="<?php echo htmlspecialchars($respostaData['Questoes_Prova_Disciplina_Professor_id_professor'] ?? ''); ?>">
            <?php else: ?>
                <select name="id_professor" id="id_professor" required>
                    <option value="">Selecione um professor</option>
                    <?php foreach ($professores as $professor): ?>
                        <option value="<?= htmlspecialchars($professor['id_professor']) ?>"><?= htmlspecialchars($professor['registroProfessor']) ?> - <?= htmlspecialchars($professor['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
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