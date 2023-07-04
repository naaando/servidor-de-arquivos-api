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
$sql = "SELECT nome_arquivo, observacoes, tamanho, extensao, upload_at FROM arquivos WHERE id_arquivo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idArquivo);
$stmt->execute();
$stmt->bind_result($nomeArquivo, $observacoes, $tamanho, $extensao, $upload_at);
$stmt->fetch();
$stmt->close();
$conn->close();

// Verifica se o arquivo foi encontrado no banco de dados
if ($nomeArquivo) {
    //retorna um json com as informações do arquivo
    $resposta = array('status' => 'success', 'nome_arquivo' => $nomeArquivo, 'tamanho' => $tamanho, 'extensao' => $extensao, 'upload_at' => $upload_at, 'observacoes' => $observacoes);
    echo json_encode($resposta);
    
} else {
    echo 'Arquivo não encontrado no banco de dados.';
}
?>
