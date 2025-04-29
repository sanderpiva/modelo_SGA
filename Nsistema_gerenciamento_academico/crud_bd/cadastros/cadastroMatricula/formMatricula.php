<?php
include '../conexao.php';

$isUpdating = false;
$matriculaData = array();
$errors = "";

// Verifica se os IDs de aluno e disciplina foram passados na URL (modo de atualização)
if (isset($_GET['id_aluno']) && !empty($_GET['id_aluno']) &&
    isset($_GET['id_disciplina']) && !empty($_GET['id_disciplina'])) {

    $isUpdating = true;
    $alunoIdToUpdate = mysqli_real_escape_string($conn, $_GET['id_aluno']);
    $disciplinaIdToUpdate = mysqli_real_escape_string($conn, $_GET['id_disciplina']);

    $sql = "SELECT Aluno_id_aluno, Disciplina_id_disciplina FROM matricula
            WHERE Aluno_id_aluno = '$alunoIdToUpdate'
            AND Disciplina_id_disciplina = '$disciplinaIdToUpdate'";

    $res = mysqli_query($conn, $sql);

    if ($res === false) {
        $errors .= "<p style='color:red;'>Erro ao buscar dados da matrícula: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
        $isUpdating = false;
    } elseif (mysqli_num_rows($res) == 1) {
        $matriculaData = mysqli_fetch_assoc($res);
    } else {
        $errors .= "<p style='color:red;'>Registro de matrícula não encontrado para os IDs fornecidos.</p>";
        $isUpdating = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Matrícula</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">

    <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaMatricula/atualizarMatricula.php' : 'validaInserirMatricula.php'; ?>" method="post">
        <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Matrícula</h2>
        <hr>

        <?php if ($isUpdating): ?>
            <label for="">Atualizar matricula?</label><br>
            <input type="hidden" name="original_id_aluno" value="<?php echo htmlspecialchars($matriculaData['Aluno_id_aluno']); ?>">
            <input type="hidden" name="original_id_disciplina" value="<?php echo htmlspecialchars($matriculaData['Disciplina_id_disciplina']); ?>">
        <?php endif; ?>

        <label for="aluno_matricula">ID Aluno:</label>
        <input type="text" name="aluno_matricula" id="aluno_matricula" placeholder="" value="<?php echo $isUpdating ? htmlspecialchars($matriculaData['Aluno_id_aluno']) : ''; ?>" required <?php echo $isUpdating ? 'readonly' : ''; ?>>
        <hr>

        <label for="id_disciplina">ID Disciplina:</label>
        <input type="text" name="id_disciplina" id="id_disciplina" placeholder="" value="<?php echo $isUpdating ? htmlspecialchars($matriculaData['Disciplina_id_disciplina']) : ''; ?>" required <?php echo $isUpdating ? 'readonly' : ''; ?>>
        <hr>

        <button type="submit"><?php echo $isUpdating ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>

    <?php
        // Exibe os erros (se houver)
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
mysqli_close($conn); // Fecha a conexão
?>