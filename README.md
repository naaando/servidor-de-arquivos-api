# servidor-de-arquivos
 Servidor de arquivos usando php, mariadb, phpmyadmin no docker

 ## Comandos comuns  
  


sudo docker exec -it servidor_arquivos_php bash  
php monta_as_tabelas.php  
  
  
sudo chmod -R a+r .env  
  
  
  
POST  
Use um binário junto com um JSON  
{  
    "observacoes":"Texto de observação para o arquivo"  
}  
  
GET  
Baixar o arquivo:  
http://URL:PORT/recupera_arquivo.php?id=CODIGODOARQUIVO  
  
Retorna um JSON com informações do arquivo:  
http://URL:PORT/recupera_informacoes_arquivo.php?id=CODIGODOARQUIVO  


