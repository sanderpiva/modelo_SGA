<?php
include '../conexao.php';

$isUpdating = false;
$professorData = array();
$errors = "";

// Verifica se um ID de professor foi passado na URL (modo de atualização)
if (isset($_GET['id_professor']) && !empty($_GET['id_professor'])) {
    $isUpdating = true;
    $idProfessorToUpdate = mysqli_real_escape_string($conn, $_GET['id_professor']);

    $sql = "SELECT * FROM professor WHERE id_professor = '$idProfessorToUpdate'";
    $res = mysqli_query($conn, $sql);

    if ($res === false) {
        $errors .= "<p style='color:red;'>Erro ao buscar dados do professor: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
        $isUpdating = false;
    } elseif (mysqli_num_rows($res) == 1) {
        $professorData = mysqli_fetch_assoc($res);
    } else {
        $errors .= "<p style='color:red;'>Professor com ID " . htmlspecialchars($idProfessorToUpdate) . " não encontrado.</p>";
        $isUpdating = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Professor</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">

    <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaProfessor/atualizarProfessor.php' : 'validaInserirProfessor.php'; ?>" method="post">
        <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Professor</h2>
        <hr>

        <label for="registroProfessor">Registro:</label>
        <?php if ($isUpdating): ?>
            <input type="text" name="registroProfessor" id="registroProfessor" placeholder="Digite o registro" value="<?php echo $isUpdating ? htmlspecialchars($professorData['registroProfessor']) : ''; ?>" required>
            <input type="hidden" name="id_professor" value="<?php echo htmlspecialchars($professorData['id_professor']); ?>">
        <?php else: ?>
            <input type="text" name="registroProfessor" id="registroProfessor" placeholder="Digite o registro" required>
        <?php endif; ?>
        <hr>

        <label for="nomeProfessor">Nome:</label>
        <input type="text" name="nomeProfessor" id="nomeProfessor" placeholder="Digite o nome" value="<?php echo $isUpdating ? htmlspecialchars($professorData['nome']) : ''; ?>" required>
        <hr>

        <label for="emailProfessor">Email:</label>
        <input type="email" name="emailProfessor" id="emailProfessor" placeholder="Digite o email" value="<?php echo $isUpdating ? htmlspecialchars($professorData['email']) : ''; ?>" required>
        <hr>

        <label for="enderecoProfessor">Endereço:</label>
        <input type="text" name="enderecoProfessor" id="enderecoProfessor" placeholder="Digite o endereço" value="<?php echo $isUpdating ? htmlspecialchars($professorData['endereco']) : ''; ?>" required>
        <hr>

        <label for="telefoneProfessor">Telefone:</label>
        <input type="text" name="telefoneProfessor" id="telefoneProfessor" placeholder="Digite o telefone" value="<?php echo $isUpdating ? htmlspecialchars($professorData['telefone']) : ''; ?>" required>
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