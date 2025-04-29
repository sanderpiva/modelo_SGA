<?php
include '../conexao.php';

$isUpdating = false;
$respostaData = array();
$errors = "";

// Verifica se um ID de resposta foi passado na URL (modo de atualização)
if (isset($_GET['id_respostas']) && !empty($_GET['id_respostas'])) {
    $isUpdating = true;
    $idRespostaToUpdate = mysqli_real_escape_string($conn, $_GET['id_respostas']);

    $sql = "SELECT * FROM respostas WHERE id_respostas = '$idRespostaToUpdate'";
    $res = mysqli_query($conn, $sql);

    if ($res === false) {
        $errors .= "<p style='color:red;'>Erro ao buscar dados da resposta: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
        $isUpdating = false;
    } elseif (mysqli_num_rows($res) == 1) {
        $respostaData = mysqli_fetch_assoc($res);
    } else {
        $errors .= "<p style='color:red;'>Resposta com ID " . htmlspecialchars($idRespostaToUpdate) . " não encontrada.</p>";
        $isUpdating = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
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
            <input type="text" name="codigoRespostas" id="codigoRespostas" placeholder="" value="<?php echo htmlspecialchars($respostaData['codigoRespostas']); ?>" required> 
            <input type="hidden" name="id_respostas" value="<?php echo htmlspecialchars($respostaData['id_respostas']); ?>">
        <?php else: ?>
            <input type="text" name="codigoRespostas" id="codigoRespostas" placeholder="" required>
        <?php endif; ?>
        <hr>

        <label for="respostaDada">Resposta Dada:</label>
        <input type="text" name="respostaDada" id="respostaDada" placeholder="" value="<?php echo $isUpdating ? htmlspecialchars($respostaData['respostaDada']) : ''; ?>" required>
        <hr>

        <label>Acertou?</label>
        <div>
            <input type="radio" id="acertouSim" name="acertou" value="1" <?php echo $isUpdating && $respostaData['acertou'] == 1 ? 'checked' : ''; ?> required>
            <label for="acertouSim">Sim</label>
            <input type="radio" id="acertouNao" name="acertou" value="0" <?php echo $isUpdating && $respostaData['acertou'] == 0 ? 'checked' : ''; ?> required>
            <label for="acertouNao">Não</label>
        </div>
        <hr>

        <label for="nota">Nota:</label>
        <input type="text" name="nota" id="nota" placeholder="" value="<?php echo $isUpdating ? htmlspecialchars($respostaData['nota']) : ''; ?>" required>
        <hr>
        <label for="id_questao">ID questao:</label>
        <input type="text" name="id_questao" id="id_questao" placeholder="" value="<?php echo $isUpdating ? htmlspecialchars($respostaData['Questoes_id_questao']) : ''; ?>" required>
        <hr>
        <label for="id_prova">ID prova:</label>
        <input type="text" name="id_prova" id="id_prova" placeholder="" value="<?php echo $isUpdating ? htmlspecialchars($respostaData['Questoes_Prova_id_prova']) : ''; ?>" required>
        <hr>
        <label for="id_disciplina">ID disciplina:</label>
        <input type="text" name="id_disciplina" id="id_disciplina" placeholder="" value="<?php echo $isUpdating ? htmlspecialchars($respostaData['Questoes_Prova_Disciplina_id_disciplina']) : ''; ?>" required>
        <hr>
        <label for="id_professor">ID professor:</label>
        <input type="text" name="id_professor" id="id_professor" placeholder="" value="<?php echo $isUpdating ? htmlspecialchars($respostaData['Questoes_Prova_Disciplina_Professor_id_professor']) : ''; ?>" required>
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