<!DOCTYPE html>
<html>
<head>
    <title>Upload de Arquivo</title>
</head>
<body>
    <form method="POST" action="recebe_upload.php" enctype="multipart/form-data" >
        <input type="file" name="arquivo">
        <br>
        <br>
        <label for="observacoes">Observações:</label>
        <br>
        <textarea name="observacoes" id="observacoes" rows="5" cols="50"></textarea>
        <br>
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>