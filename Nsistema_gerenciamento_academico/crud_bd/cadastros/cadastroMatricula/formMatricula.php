<?php
require_once '../conexao.php';

$isUpdating = false;
$matriculaData = [];
$errors = "";

// Verifica se os IDs de aluno e disciplina foram passados na URL (modo de atualização)
if (isset($_GET['id_aluno']) && !empty($_GET['id_aluno']) &&
    isset($_GET['id_disciplina']) && !empty($_GET['id_disciplina'])) {

    $isUpdating = true;
    $alunoIdToUpdate = $_GET['id_aluno'];
    $disciplinaIdToUpdate = $_GET['id_disciplina'];

    $stmt = $conexao->prepare("SELECT Aluno_id_aluno, Disciplina_id_disciplina FROM matricula
                                WHERE Aluno_id_aluno = :aluno_id
                                AND Disciplina_id_disciplina = :disciplina_id");
    $stmt->execute([':aluno_id' => $alunoIdToUpdate, ':disciplina_id' => $disciplinaIdToUpdate]);
    $matriculaData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$matriculaData) {
        $errors = "<p style='color:red;'>Registro de matrícula não encontrado para os IDs fornecidos.</p>";
        $isUpdating = false;
    }
} else {
    $errors = "<p style='color:red;'>IDs de aluno e disciplina não fornecidos.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Matrícula</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">
        <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaMatricula/atualizarMatricula.php' : 'validaInserirMatricula.php'; ?>" method="post">
            <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Matrícula</h2>
            <hr>

            <?php if ($isUpdating): ?>
                <label for="">Atualizar matrícula?</label><br>
                <input type="hidden" name="original_id_aluno" value="<?php echo htmlspecialchars(isset($matriculaData['Aluno_id_aluno']) ? $matriculaData['Aluno_id_aluno'] : ''); ?>">
                <input type="hidden" name="original_id_disciplina" value="<?php echo htmlspecialchars(isset($matriculaData['Disciplina_id_disciplina']) ? $matriculaData['Disciplina_id_disciplina'] : ''); ?>">
            <?php endif; ?>

            <label for="aluno_matricula">ID Aluno:</label>
            <input type="text" name="aluno_matricula" id="aluno_matricula" placeholder="" value="<?php echo htmlspecialchars($matriculaData['Aluno_id_aluno'] ?? ''); ?>" required <?php echo $isUpdating ? 'readonly' : ''; ?>>
            <hr>

            <label for="disciplina_id">ID Disciplina:</label>
            <input type="text" name="disciplina_id" id="disciplina_id" placeholder="" value="<?php echo htmlspecialchars($matriculaData['Disciplina_id_disciplina'] ?? ''); ?>" required <?php echo $isUpdating ? 'readonly' : ''; ?>>
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