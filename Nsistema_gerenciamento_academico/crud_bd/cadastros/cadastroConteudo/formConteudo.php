<?php
require_once '../conexao.php';

$disciplinas = $conexao->query("SELECT * FROM disciplina")->fetchAll(PDO::FETCH_ASSOC);

$isUpdating = false;
$conteudoData = [];
$errors = "";

if (isset($_GET['id_conteudo'])) {
    $idConteudoToUpdate = $_GET['id_conteudo'];

    $stmt = $conexao->prepare("SELECT * FROM conteudo WHERE id_conteudo = :id");
    $stmt->execute([':id' => $idConteudoToUpdate]);
    $conteudoData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$conteudoData) {
        $errors = "<p style='color:red;'>Conteúdo com ID $idConteudoToUpdate não encontrado.</p>";
        $isUpdating = false;
    } else {
        $isUpdating = true;
    }
} 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Conteúdo</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">
        <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaConteudo/atualizarConteudo.php' : 'validaInserirConteudo.php'; ?>" method="post">
            <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Conteúdo</h2>
            <hr>

            <label for="codigoConteudo">Código do conteúdo:</label>
            <?php if ($isUpdating): ?>
                <input type="text" name="codigoConteudo" id="codigoConteudo" placeholder="Digite o código" value="<?php echo htmlspecialchars(isset($conteudoData['codigoConteudo']) ? $conteudoData['codigoConteudo'] : ''); ?>" required>
                <input type="hidden" name="id_conteudo" value="<?php echo htmlspecialchars(isset($conteudoData['id_conteudo']) ? $conteudoData['id_conteudo'] : ''); ?>">
            <?php else: ?>
                <input type="text" name="codigoConteudo" id="codigoConteudo" placeholder="Digite o código" required>
            <?php endif; ?>
            <hr>

            <label for="tituloConteudo">Título:</label>
            <input type="text" name="tituloConteudo" id="tituloConteudo" placeholder="Digite o título" value="<?php echo htmlspecialchars(isset($conteudoData['titulo']) ? $conteudoData['titulo'] : ''); ?>" required>
            <hr>

            <label for="descricaoConteudo">Descrição:</label>
            <input type="text" name="descricaoConteudo" id="descricaoConteudo" placeholder="Digite a descrição" value="<?php echo htmlspecialchars(isset($conteudoData['descricao']) ? $conteudoData['descricao'] : ''); ?>" required>
            <hr>

            <label for="data_postagem">Data de postagem:</label>
            <input type="date" name="data_postagem" id="data_postagem" value="<?php echo htmlspecialchars(isset($conteudoData['data_postagem']) ? $conteudoData['data_postagem'] : ''); ?>" required>
            <hr>

            <label for="professor">Professor:</label>
            <input type="text" name="professor" id="professor" placeholder="Digite o autor" value="<?php echo htmlspecialchars(isset($conteudoData['professor']) ? $conteudoData['professor'] : ''); ?>" required>
            <hr>

            <label for="disciplina">Disciplina:</label>
            <input type="text" name="disciplina" id="disciplina" placeholder="Digite a disciplina" value="<?php echo htmlspecialchars(isset($conteudoData['disciplina']) ? $conteudoData['disciplina'] : ''); ?>" required>
            <hr>

            <label for="tipo_conteudo">Tipo de conteúdo:</label>
            <input type="text" name="tipo_conteudo" id="tipo_conteudo" placeholder="Digite o tipo" value="<?php echo htmlspecialchars(isset($conteudoData['tipo_conteudo']) ? $conteudoData['tipo_conteudo'] : ''); ?>" required>
            <hr>
            
            <label for="id_disciplina">Nome da disciplina:</label>
            <select name="id_disciplina" required>
			<?php foreach ($disciplinas as $disciplina){ ?>
				<option value="<?= $disciplina['id_disciplina'] ?>"><?= htmlspecialchars($disciplina['nome']) ?></option>
			<?php } ?>
		    </select>
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