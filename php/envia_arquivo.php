<?php
// Obtém o ID do arquivo do parâmetro GET
if (!isset($_GET['id'])) {
    echo 'ID do arquivo não fornecido.';
    exit;
}
$idArquivo = $_GET['id'];


// Conecta ao banco de dados
include 'connect.php';

// Executa a consulta no banco de dados
$sql = "SELECT nome_arquivo FROM arquivos WHERE id_arquivo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idArquivo);
$stmt->execute();
$stmt->bind_result($nomeArquivo);
$stmt->fetch();
$stmt->close();
$conn->close();

// Verifica se o arquivo foi encontrado no banco de dados
if ($nomeArquivo) {
    //echo 'Nome do arquivo encontrado: ' . $nomeArquivo;
    $filePath = 'arquivos_recebidos/'.$idArquivo;

    // Verifica se o arquivo existe
    if (file_exists($filePath)) {
        // Define o novo nome do arquivo para o download
        header('Content-Disposition: attachment; filename="' . $nomeArquivo . '"');
        // Envia o arquivo para o navegador
        readfile($filePath);
    } else {
        echo 'Arquivo não encontrado.';
    }
} else {
    echo 'Arquivo não encontrado no banco de dados.';
}
?>
