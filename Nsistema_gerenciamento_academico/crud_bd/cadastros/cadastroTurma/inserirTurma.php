<?php

  $servidor = 'localhost';
  $usuario = 'root';
  $senha = '';
  $banco = 'gerenciamento_academico_completo';

    try 
    {
        $dsn = "mysql:host=$servidor;dbname=$banco;charset=utf8"; 
        $conexao = new PDO($dsn, $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $codigoTurma  = $_POST['codigoTurma'] ?? '';
            $nomeTurma   = $_POST['nomeTurma'] ?? '';
            
            $sql = "INSERT INTO turma (codigoTurma, nomeTurma) VALUES (:codigoTurma, :nomeTurma)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                ':codigoTurma'  => $codigoTurma,
                ':nomeTurma'   => $nomeTurma,
                
            ]);
    
            echo "<p>Turma cadastrada com sucesso!</p>";
            echo '<p><a href="../../../servicos_professor/pagina_servicos_professor.php" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Dashboard</a></p>';
    
        } else {
            echo "<p>Requisição inválida.</p>";
            echo '<p><a href="formTurma.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar ou cadastrar: " . $e->getMessage();
        echo '<p><a href="formTurma.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';
    }    
  
?>





