<?php
include '../conexao.php';

$isUpdating = false;
$turmaData = array();
$errors = "";

// Verifica se um ID de turma foi passado na URL (modo de atualização)
if (isset($_GET['id_turma']) && !empty($_GET['id_turma'])) {
    $isUpdating = true;
    $idTurmaToUpdate = mysqli_real_escape_string($conn, $_GET['id_turma']);

    $sql = "SELECT * FROM turma WHERE id_turma = '$idTurmaToUpdate'";
    $res = mysqli_query($conn, $sql);

    if ($res === false) {
        $errors .= "<p style='color:red;'>Erro ao buscar dados da turma: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
        $isUpdating = false; // Volta para o modo de cadastro se houver erro na busca
    } elseif (mysqli_num_rows($res) == 1) {
        $turmaData = mysqli_fetch_assoc($res); // Obtém os dados da turma
    } else {
        $errors .= "<p style='color:red;'>Turma com ID " . htmlspecialchars($idTurmaToUpdate) . " não encontrada.</p>";
        $isUpdating = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Turma</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">

    <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaTurma/atualizarTurma.php' : 'validaInserirTurma.php'; ?>" method="post">
        <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Turma</h2>
        <hr>

        <label for="codigoTurma">Código Turma:</label>
        <?php if ($isUpdating): ?>
            <input type="text" name="codigoTurma" id="codigoTurma" value="<?php echo htmlspecialchars($turmaData['codigoTurma']); ?>" required>
            <input type="hidden" name="id_turma" value="<?php echo htmlspecialchars($turmaData['id_turma']); ?>">
        <?php else: ?>
            <input type="text" name="codigoTurma" id="codigoTurma" placeholder="" required>
        <?php endif; ?>
        <hr>

        <label for="nome_turma">Nome da turma (Ex: 6 serie A):</label>
        <input type="text" name="nome_turma" id="nome_turma" placeholder="" value="<?php echo $isUpdating ? htmlspecialchars($turmaData['nomeTurma']) : ''; ?>" required>
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