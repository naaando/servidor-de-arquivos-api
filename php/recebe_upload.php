<?php
//ini_set('post_max_size', '20M');


// Recebe os dados em formato JSON
$data = json_decode(file_get_contents('php://input'), true);

$observacoes = null;

// Verifica se recebeu observacoes
if (!empty($data['observacoes'])) {
    $observacoes = $data['observacoes'];
}

// Verifica se recebeu observacoes
if (!empty($_POST['observacoes'])) {
    $observacoes = $_POST['observacoes'];
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Método de requisição inválido
    $resposta = array('status' => 'error', 'mensagem' => 'Método de requisição inválido.');
    echo json_encode($resposta);
    return;
}

// Verifica se um arquivo foi enviado
if (!isset($_FILES['arquivo'])) {
    // Nenhum arquivo enviado
    $resposta = array('status' => 'error', 'mensagem' => 'Nenhum arquivo enviado.');
    echo json_encode($resposta);
    return;
}

$diretorioDestino = 'arquivos_recebidos'; // Diretório onde o arquivo será salvo

// Verifica se houve algum erro no upload do arquivo
if ($_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    // Erro no upload do arquivo
    $resposta = array('status' => 'error', 'mensagem' => 'Erro no upload do arquivo.');
    echo json_encode($resposta);
    return;
}

$nomeArquivoOriginal = $_FILES['arquivo']['name'];
$extensao = pathinfo($nomeArquivoOriginal, PATHINFO_EXTENSION);
$nomeArquivo = uniqid();
$caminhoCompleto = $diretorioDestino . '/' . $nomeArquivo;
$tamanho = $_FILES['arquivo']['size'];

$statusSalvouNoBanco = salvaNoBancoDeDados($nomeArquivoOriginal, $extensao, $nomeArquivo, $observacoes, $tamanho);

// Move o arquivo para o diretório de destino
if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminhoCompleto)) {
    // Erro ao mover o arquivo
    $resposta = array('status' => 'error', 'mensagem' => 'Erro ao mover o arquivo para o diretório de destino.');
    echo json_encode($resposta);
    return;
}

// Arquivo salvo com sucesso
$resposta = array(
    'status' => 'success',
    'mensagem' => 'Arquivo salvo com sucesso.',
    'nomeArquivoOriginal' => $nomeArquivoOriginal,
    'extensao' => $extensao,
    'nomeArquivo' => $nomeArquivo,
    'caminhoCompleto' => $caminhoCompleto,
    'tamanho' => retornaTamanho($tamanho) . ' MB',
);

// Define o cabeçalho da resposta como JSON
//header('Content-Type: application/json');

// Retorna a resposta como JSON
echo json_encode($resposta);



function retornaTamanho($tamanho) {
    //parse float e calcula o tamanho em MB
    $tamanho = floatval($tamanho);
    $tamanho = $tamanho / 1024 / 1024;

    //formata o tamanho para 2 casas decimais
    $tamanho = round($tamanho, 2);

    //parse string e retorna
    $tamanho = strval($tamanho);
    
    return $tamanho;
}

function salvaNoBancoDeDados($nomeArquivoOriginal, $extensao, $nomeArquivo, $observacoes, $tamanho){

    include_once("connect.php");

    $tamanho = retornaTamanho($tamanho);

    // Define o comando SQL
    $sql = "INSERT INTO arquivos (nome_arquivo, extensao, id_arquivo, observacoes, tamanho) VALUES (?, ?, ?, ?, ?)";

    // Prepara o comando SQL para ser executado
    $stmt = mysqli_prepare($conn, $sql);

    // Associa os parâmetros do comando SQL aos parâmetros da função mysqli_stmt_bind_param
    mysqli_stmt_bind_param($stmt, "sssss", $nomeArquivoOriginal, $extensao, $nomeArquivo, $observacoes, $tamanho);

    // Executa o comando SQL
    mysqli_stmt_execute($stmt);

    // Verifica se o comando foi executado com sucesso
    if (mysqli_stmt_affected_rows($stmt) == 1) {
        // Fecha o comando e a conexão com o banco de dados
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return true;
    } else {
        // Fecha o comando e a conexão com o banco de dados
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
  
}
?>
