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
            
            $registroProfessor  = $_POST['registroProfessor'] ?? '';
            $nomeProfessor   = $_POST['nomeProfessor'] ?? '';
            $emailProfessor  = $_POST['emailProfessor'] ?? '';
            $enderecoProfessor = $_POST['enderecoProfessor'] ?? '';
            $telefoneProfessor = $_POST['telefoneProfessor'] ?? '';
    
            $sql = "INSERT INTO professor (registroProfessor, nome, email, endereco, telefone) VALUES (:registroProfessor, :nome, :email, :endereco, :telefone)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                ':registroProfessor'  => $registroProfessor,
                ':nome'   => $nomeProfessor,
                ':email'  => $emailProfessor,
                ':endereco' => $enderecoProfessor,
                ':telefone' => $telefoneProfessor
            ]);
    
            echo "<p>Professor(a) cadastrado com sucesso!</p>";
            echo '<p><a href="../../../servicos_professor/pagina_servicos_professor.php" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Dashboard</a></p>';
    
        } else {
            echo "<p>Requisição inválida.</p>";
            echo '<p><a href="formProfessor.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar ou cadastrar: " . $e->getMessage();
        echo '<p><a href="formProfessor.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';
    }
    
  
?>



