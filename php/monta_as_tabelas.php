<?php


    //conecta ao banco de dados mariadb
    include_once("connect.php");

    // Define o comando SQL
    $sql = "CREATE TABLE arquivos (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome_arquivo VARCHAR(250) NOT NULL,
        extensao VARCHAR(10),
        id_arquivo VARCHAR(30) NOT NULL,
        observacoes VARCHAR(500),
        tamanho VARCHAR(30) NOT NULL,
        upload_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

    // Executa o comando SQL
    if (mysqli_query($conn, $sql)) {
        echo "Tabela arquivos criada com sucesso.";
    } else {
        echo "Erro ao criar a tabela: " . mysqli_error($conn);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);

?>