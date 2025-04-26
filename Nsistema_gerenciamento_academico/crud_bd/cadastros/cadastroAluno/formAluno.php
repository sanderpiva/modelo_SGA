<?php
include '../conexao.php';

$isUpdating = false;
$alunoData = array(); // Array para armazenar os dados do aluno em caso de atualização
$errors = "";

// Verifica se um ID de aluno foi passado na URL (modo de atualização)
if (isset($_GET['id_aluno']) && !empty($_GET['id_aluno'])) {
    $isUpdating = true;
    $idAlunoToUpdate = mysqli_real_escape_string($conn, $_GET['id_aluno']);

    $sql = "SELECT * FROM aluno WHERE id_aluno = '$idAlunoToUpdate'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {
        $alunoData = mysqli_fetch_assoc($res);
    } else {
        $errors = "<p style='color:red;'>Aluno com ID $idAlunoToUpdate não encontrado.</p>";
        $isUpdating = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Web - <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Aluno</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body class="servicos_forms">

    <div class="form_container">
        <form class="form" action="<?php echo $isUpdating ? '../../consultas/consultaAluno/atualizarAluno.php' : 'validaInserirAluno.php'; ?>" method="post">
            <h2>Formulário: <?php echo $isUpdating ? 'Atualizar' : 'Cadastro'; ?> Aluno</h2>
            <hr>

            <label for="matricula">Matrícula:</label>
            <?php if ($isUpdating): ?>
                <input type="text" name="matricula" id="matricula" placeholder="Digite a matrícula" value="<?php echo $isUpdating ? htmlspecialchars($alunoData['matricula']) : ''; ?>" required>
                <input type="hidden" name="id_aluno" value="<?php echo htmlspecialchars($alunoData['id_aluno']); ?>">
            <?php else: ?>
                <input type="text" name="matricula" id="matricula" placeholder="Digite a matrícula" required>
            <?php endif; ?>
            <hr>

            <label for="nomeAluno">Nome:</label>
            <input type="text" name="nomeAluno" id="nomeAluno" placeholder="Digite o nome" value="<?php echo $isUpdating ? htmlspecialchars($alunoData['nome']) : ''; ?>" required>
            <hr>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" placeholder="Digite o CPF" value="<?php echo $isUpdating ? htmlspecialchars($alunoData['cpf']) : ''; ?>" required>
            <hr>

            <label for="emailAluno">Email:</label>
            <input type="email" name="emailAluno" id="emailAluno" placeholder="Digite o email" value="<?php echo $isUpdating ? htmlspecialchars($alunoData['email']) : ''; ?>" required>
            <hr>

            <label for="data_nascimento">Data nascimento:</label>
             <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo $isUpdating ? htmlspecialchars($alunoData['data_nascimento']) : ''; ?>" required>
            <hr>

            <label for="enderecoAluno">Endereço:</label>
            <input type="text" name="enderecoAluno" id="enderecoAluno" placeholder="Digite o endereço" value="<?php echo $isUpdating ? htmlspecialchars($alunoData['endereco']) : ''; ?>" required>
            <hr>

            <label for="cidadeAluno">Cidade:</label>
            <input type="text" name="cidadeAluno" id="cidadeAluno" placeholder="Digite a cidade" value="<?php echo $isUpdating ? htmlspecialchars($alunoData['cidade']) : ''; ?>" required>
            <hr>

            <label for="telefoneAluno">Telefone:</label>
            <input type="text" name="telefoneAluno" id="telefoneAluno" placeholder="Digite o telefone" value="<?php echo $isUpdating ? htmlspecialchars($alunoData['telefone']) : ''; ?>" required>
            <hr>

            <label for="id_turma">ID Turma:</label>
            <input type="text" name="id_turma" id="id_turma" placeholder="Digite id turma" value="<?php echo $isUpdating ? htmlspecialchars($alunoData['Turma_id_turma']) : ''; ?>" required>
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