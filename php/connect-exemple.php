<?php
    //conecta ao banco de dados mariadb
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "arquivos";

    // Cria a conexão
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Checa a conexão
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    