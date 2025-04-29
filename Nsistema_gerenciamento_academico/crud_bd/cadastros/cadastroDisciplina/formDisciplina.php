<?php
include '../conexao.php';

$isUpdating = false;
$disciplinaData = array(); // Array para armazenar os dados da disciplina em caso de atualização
$errors = "";

// Verifica se um ID de disciplina foi passado na URL (modo de atualização)
if (isset($_GET['id_disciplina']) && !empty($_GET['id_disciplina'])) {
    $isUpdating = true;
    $idDisciplinaToUpdate = mysqli_real_escape_string($conn, $_GET['id_disciplina']);

    $sql = "SELECT * FROM disciplina WHERE id_disciplina = '$idDisciplinaToUpdate'";
    $res = mysqli_query($conn, $sql);

    if ($res === false) {
        $errors .= "<p style='color:red;'>Erro ao buscar dados da disciplina: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
        $isUpdating = false;
    } elseif (mysqli_num_rows($res) == 1) {
        $disciplinaData = mysqli_fetch_assoc($res);
    } else {
        $errors .= "<p style='color:red;'>Disciplina com ID " . htmlspecialchars($idDisciplinaToUpdate) . " não encontrada.</p>";
        $isUpdating = false; // Volta para o modo de cadastro se a disciplina não for encontrada
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Disciplina</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">

    <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaDisciplina/atualizarDisciplina.php' : 'validaInserirDisciplina.php'; ?>" method="post">
        <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Disciplina</h2>
        <hr>

        <label for="codigoDisciplina">Código da disciplina:</label>
        <?php if ($isUpdating): ?>
            <input type="text" name="codigoDisciplina" id="codigoDisciplina" placeholder="Digite o código" value="<?php echo $isUpdating ? htmlspecialchars($disciplinaData['codigoDisciplina']) : ''; ?>" required>
            <input type="hidden" name="id_disciplina" value="<?php echo htmlspecialchars($disciplinaData['id_disciplina']); ?>">
        <?php else: ?>
            <input type="text" name="codigoDisciplina" id="codigoDisciplina" placeholder="Digite o código" required>
        <?php endif; ?>
        <hr>

        <label for="nomeDisciplina">Nome da disciplina:</label>
        <input type="text" name="nomeDisciplina" id="nomeDisciplina" placeholder="Digite o nome" value="<?php echo $isUpdating ? htmlspecialchars($disciplinaData['nome']) : ''; ?>" required>
        <hr>

        <label for="carga_horaria">Carga horária:</label>
        <input type="number" min="10" name="carga_horaria" id="carga_horaria" placeholder="Digite a carga horária" value="<?php echo $isUpdating ? htmlspecialchars($disciplinaData['carga_horaria']) : ''; ?>" required>
        <hr>

        <label for="professor">Professor:</label>
        <input type="text" name="professor" id="professor" placeholder="Digite o professor" value="<?php echo $isUpdating ? htmlspecialchars($disciplinaData['professor']) : ''; ?>" required>
        <hr>

        <label for="descricaoDisciplina">Descrição da disciplina:</label>
        <input type="text" name="descricaoDisciplina" id="descricaoDisciplina" placeholder="Digite a descrição" value="<?php echo $isUpdating ? htmlspecialchars($disciplinaData['descricao']) : ''; ?>" required>
        <hr>

        <label for="semestre_periodo">Semestre/Período:</label>
        <input type="text" name="semestre_periodo" id="semestre_periodo" placeholder="Digite o semestre/período" value="<?php echo $isUpdating ? htmlspecialchars($disciplinaData['semestre_periodo']) : ''; ?>" required>
        <hr>

        <label for="Professor_id_professor">ID do Professor:</label>
        <?php if ($isUpdating): ?>
            <input type="text" value="<?php echo htmlspecialchars($disciplinaData['Professor_id_professor']); ?>" readonly required>
            <input type="hidden" name="Professor_id_professor" value="<?php echo htmlspecialchars($disciplinaData['Professor_id_professor']); ?>">
        <?php else: ?>
            <input type="text" name="Professor_id_professor" id="Professor_id_professor" placeholder="Digite o ID do professor" required>
        <?php endif; ?>
        <hr>

        <label for="id_turma">ID turma:</label>
        <input type="text" name="id_turma" id="id_turma" placeholder="Digite ID turma:" value="<?php echo $isUpdating ? htmlspecialchars($disciplinaData['Turma_id_turma']) : ''; ?>" required>
        <hr>

        <button type="submit"><?php echo $isUpdating ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>

    <?php
        echo $errors;
    ?>
    <hr>
    </div>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>
    <hr>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>

</html>
<?php
mysqli_close($conn);
?>