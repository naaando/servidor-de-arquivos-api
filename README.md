![Takatsu's Projects](https://wesleytakatsu.github.io/Pagina-Apresentacao-Pessoal/media/img/Logo-Takatsu-Projetos.png)


*[Conheça minha página de apresentação!](https://wesleytakatsu.github.io/Pagina-Apresentacao-Pessoal/)*
  
  
# servidor-de-arquivos
 Servidor de arquivos usando php, mariadb, phpmyadmin no docker

 ## Comandos comuns  
 docker-compose up -d
 docker-compose down
  
  
### Para entrar no container do PHP:  
sudo docker exec -it servidor_arquivos_php bash  
Para criar a tabela usando PHP:  
php monta_as_tabelas.php  

Pode importar o .sql para o banco através do PHPMyAdmin se preferir.  
  
  
sudo chmod -R a+r .env  
  

## Tamanho máximo do arquivo  
Mude o arquivo php_config/php.ini  
  
  
### POST  
Use um binário junto com um JSON  
{  
    "observacoes" : "Texto de observação para o arquivo"  
}  
  
### GET  
Baixar o arquivo:  
http://URL:PORT/recupera_arquivo.php?id=CODIGODOARQUIVO  
  
Retorna um JSON com informações do arquivo:  
http://URL:PORT/recupera_informacoes_arquivo.php?id=CODIGODOARQUIVO  


