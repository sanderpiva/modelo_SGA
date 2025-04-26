<?php
include '../conexao.php';

$isUpdating = false;
$conteudoData = array(); // Array para armazenar os dados do conteúdo em caso de atualização
$errors = "";

// Verifica se um ID de conteúdo foi passado na URL (modo de atualização)
if (isset($_GET['id_conteudo']) && !empty($_GET['id_conteudo'])) {
    $isUpdating = true;
    $idConteudoToUpdate = mysqli_real_escape_string($conn, $_GET['id_conteudo']);

    $sql = "SELECT * FROM conteudo WHERE id_conteudo = '$idConteudoToUpdate'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {
        $conteudoData = mysqli_fetch_assoc($res);
    } else {
        $errors = "<p style='color:red;'>Conteúdo com ID $idConteudoToUpdate não encontrado.</p>";
        $isUpdating = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Conteúdo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">

    <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaConteudo/atualizarConteudo.php' : 'validaInserirConteudo.php'; ?>" method="post">
        <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Conteúdo</h2>
        <hr>

        <label for="codigoConteudo">Código do conteúdo:</label>
        <?php if ($isUpdating): ?>
            <input type="text" name="codigoConteudo" id="codigoConteudo" placeholder="Digite o código" value="<?php echo $isUpdating ? htmlspecialchars($conteudoData['codigoConteudo']) : ''; ?>" required>
            <input type="hidden" name="id_conteudo" value="<?php echo htmlspecialchars($conteudoData['id_conteudo']); ?>">
        <?php else: ?>
            <input type="text" name="codigoConteudo" id="codigoConteudo" placeholder="Digite o código" required>
        <?php endif; ?>
        <hr>

        <label for="tituloConteudo">Título:</label>
        <input type="text" name="tituloConteudo" id="tituloConteudo" placeholder="Digite o título" value="<?php echo $isUpdating ? htmlspecialchars($conteudoData['titulo']) : ''; ?>" required>
        <hr>

        <label for="descricaoConteudo">Descrição:</label>
        <input type="text" name="descricaoConteudo" id="descricaoConteudo" placeholder="Digite a descrição" value="<?php echo $isUpdating ? htmlspecialchars($conteudoData['descricao']) : ''; ?>" required>
        <hr>

        <label for="data_postagem">Data de postagem:</label>
        <input type="date" name="data_postagem" id="data_postagem" value="<?php echo $isUpdating ? htmlspecialchars($conteudoData['data_postagem']) : ''; ?>" required>
        <hr>

        <label for="professor">Professor:</label>
        <input type="text" name="professor" id="professor" placeholder="Digite o autor" value="<?php echo $isUpdating ? htmlspecialchars($conteudoData['professor']) : ''; ?>" required>
        <hr>

        <label for="disciplina">Disciplina:</label>
        <input type="text" name="disciplina" id="disciplina" placeholder="Digite a disciplina" value="<?php echo $isUpdating ? htmlspecialchars($conteudoData['disciplina']) : ''; ?>" required>
        <hr>

        <label for="tipo_conteudo">Tipo de conteúdo:</label>
        <input type="text" name="tipo_conteudo" id="tipo_conteudo" placeholder="Digite o tipo" value="<?php echo $isUpdating ? htmlspecialchars($conteudoData['tipo_conteudo']) : ''; ?>" required>
        <hr>

        <label for="id_disciplina">ID disciplina:</label>
        <input type="text" name="id_disciplina" id="id_disciplina" placeholder="Digite id disciplina" value="<?php echo $isUpdating ? htmlspecialchars($conteudoData['tipo_conteudo']) : ''; ?>" required>
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