<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gerenciamento_academico_completo";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Falha na conexão: " . mysqli_connect_error());
    }
?>