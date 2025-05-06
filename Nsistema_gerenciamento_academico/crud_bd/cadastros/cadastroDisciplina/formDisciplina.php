<?php
require_once '../conexao.php';

$isUpdating = false;
$disciplinaData = [];
$errors = "";

if (isset($_GET['id_disciplina'])) {
    $idDisciplinaToUpdate = $_GET['id_disciplina'];

    $stmt = $conexao->prepare("SELECT * FROM disciplina WHERE id_disciplina = :id");
    $stmt->execute([':id' => $idDisciplinaToUpdate]);
    $disciplinaData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$disciplinaData) {
        $errors = "<p style='color:red;'>Disciplina com ID $idDisciplinaToUpdate não encontrada.</p>";
        $isUpdating = false;
    } else {
        $isUpdating = true;
    }
} else {
    $errors = "<p style='color:red;'>ID da disciplina não fornecido.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Disciplina</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">
        <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaDisciplina/atualizarDisciplina.php' : 'validaInserirDisciplina.php'; ?>" method="post">
            <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Disciplina</h2>
            <hr>

            <label for="codigoDisciplina">Código da disciplina:</label>
            <?php if ($isUpdating): ?>
                <input type="text" name="codigoDisciplina" id="codigoDisciplina" placeholder="Digite o código" value="<?php echo htmlspecialchars(isset($disciplinaData['codigoDisciplina']) ? $disciplinaData['codigoDisciplina'] : ''); ?>" required>
                <input type="hidden" name="id_disciplina" value="<?php echo htmlspecialchars(isset($disciplinaData['id_disciplina']) ? $disciplinaData['id_disciplina'] : ''); ?>">
            <?php else: ?>
                <input type="text" name="codigoDisciplina" id="codigoDisciplina" placeholder="Digite o código" required>
            <?php endif; ?>
            <hr>

            <label for="nomeDisciplina">Nome da disciplina:</label>
            <input type="text" name="nomeDisciplina" id="nomeDisciplina" placeholder="Digite o nome" value="<?php echo htmlspecialchars(isset($disciplinaData['nome']) ? $disciplinaData['nome'] : ''); ?>" required>
            <hr>

            <label for="carga_horaria">Carga horária:</label>
            <input type="number" min="10" name="carga_horaria" id="carga_horaria" placeholder="Digite a carga horária" value="<?php echo htmlspecialchars(isset($disciplinaData['carga_horaria']) ? $disciplinaData['carga_horaria'] : ''); ?>" required>
            <hr>

            <label for="professor">Professor:</label>
            <input type="text" name="professor" id="professor" placeholder="Digite o professor" value="<?php echo htmlspecialchars(isset($disciplinaData['professor']) ? $disciplinaData['professor'] : ''); ?>" required>
            <hr>

            <label for="descricaoDisciplina">Descrição da disciplina:</label>
            <input type="text" name="descricaoDisciplina" id="descricaoDisciplina" placeholder="Digite a descrição" value="<?php echo htmlspecialchars(isset($disciplinaData['descricao']) ? $disciplinaData['descricao'] : ''); ?>" required>
            <hr>

            <label for="semestre_periodo">Semestre/Período:</label>
            <input type="text" name="semestre_periodo" id="semestre_periodo" placeholder="Digite o semestre/período" value="<?php echo htmlspecialchars(isset($disciplinaData['semestre_periodo']) ? $disciplinaData['semestre_periodo'] : ''); ?>" required>
            <hr>

            <label for="Professor_id_professor">ID do Professor:</label>
            <?php if ($isUpdating): ?>
                <input type="text" value="<?php echo htmlspecialchars(isset($disciplinaData['Professor_id_professor']) ? $disciplinaData['Professor_id_professor'] : ''); ?>" readonly required>
                <input type="hidden" name="Professor_id_professor" value="<?php echo htmlspecialchars(isset($disciplinaData['Professor_id_professor']) ? $disciplinaData['Professor_id_professor'] : ''); ?>">
            <?php else: ?>
                <input type="text" name="Professor_id_professor" id="Professor_id_professor" placeholder="Digite o ID do professor" required>
            <?php endif; ?>
            <hr>

            <label for="id_turma">ID turma:</label>
            <input type="text" name="id_turma" id="id_turma" placeholder="Digite ID turma:" value="<?php echo htmlspecialchars(isset($disciplinaData['Turma_id_turma']) ? $disciplinaData['Turma_id_turma'] : ''); ?>" required>
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