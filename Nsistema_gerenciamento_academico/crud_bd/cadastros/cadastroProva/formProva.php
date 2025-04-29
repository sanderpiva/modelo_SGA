<?php
include '../conexao.php';

$isUpdating = false;
$provaData = array(); // Array para armazenar os dados da prova em caso de atualização
$errors = "";

// Verifica se um ID de prova foi passado na URL (modo de atualização)
if (isset($_GET['id_prova']) && !empty($_GET['id_prova'])) {
    $isUpdating = true;
    $idProvaToUpdate = mysqli_real_escape_string($conn, $_GET['id_prova']);

    $sql = "SELECT * FROM prova WHERE id_prova = '$idProvaToUpdate'";
    $res = mysqli_query($conn, $sql);

    if ($res === false) {
        $errors .= "<p style='color:red;'>Erro ao buscar dados da prova: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
        $isUpdating = false;
    } elseif (mysqli_num_rows($res) == 1) {
        $provaData = mysqli_fetch_assoc($res);
    } else {
        $errors .= "<p style='color:red;'>Prova com ID " . htmlspecialchars($idProvaToUpdate) . " não encontrada.</p>";
        $isUpdating = false;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Prova</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">

    <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaProva/atualizarProva.php' : 'validaInserirProva.php'; ?>" method="post">
        <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Prova</h2>
        <hr>

        <label for="codigoProva">Codigo da prova:</label>
        <?php if ($isUpdating): ?>
            <input type="text" name="codigoProva" id="codigoProva" placeholder="Digite codigo" value="<?php echo $isUpdating ? htmlspecialchars($provaData['codigoProva']) : ''; ?>" required> 
            <input type="hidden" name="id_prova" value="<?php echo htmlspecialchars($provaData['id_prova']); ?>">
        <?php else: ?>
            <input type="text" name="codigoProva" id="codigoProva" placeholder="Digite codigo" required>
        <?php endif; ?>
        <hr>

        <label for="tipo_prova">Tipo de prova:</label>
        <input type="text" name="tipo_prova" id="tipo_prova" placeholder="Digite tipo de prova" value="<?php echo $isUpdating ? htmlspecialchars($provaData['tipo_prova']) : ''; ?>" required>
        <hr>

        <label for="disciplina">Disciplina:</label>
        <input type="text" name="disciplina" id="disciplina" placeholder="Digite disciplina" value="<?php echo $isUpdating ? htmlspecialchars($provaData['disciplina']) : ''; ?>" required>
        <hr>

        <label for="conteudo">Conteudo de prova:</label>
        <input type="text" name="conteudo" id="conteudo" placeholder="Digite conteudo" value="<?php echo $isUpdating ? htmlspecialchars($provaData['conteudo']) : ''; ?>" required>
        <hr>

        <label for="data_prova">Data da prova:</label>
        <input type="date" name="data_prova" id="data_prova" placeholder="Digite a data" value="<?php echo $isUpdating ? htmlspecialchars($provaData['data_prova']) : ''; ?>" required>
        <hr>

        <label for="professor">Professor:</label>
        <input type="text" name="professor" id="professor" placeholder="Digite professor" value="<?php echo $isUpdating ? htmlspecialchars($provaData['professor']) : ''; ?>" required>
        <hr>

        <label for="id_disciplina">ID disciplina:</label>
        <input type="text" name="id_disciplina" id="id_disciplina" placeholder="Digite professor" value="<?php echo $isUpdating ? htmlspecialchars($provaData['Disciplina_id_disciplina']) : ''; ?>" required>
        <hr>

        <label for="id_professor">ID Professor:</label>
        <input type="text" name="id_professor" id="id_professor" placeholder="Digite professor" value="<?php echo $isUpdating ? htmlspecialchars($provaData['Disciplina_Professor_id_professor']) : ''; ?>" required>
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