# CMS de testes sem Framework

Sistema de gerenciamento de conteúdo de testes desenvolvido sem utilizar frameworks.

- [x] Sistema de login
- [x] Visualização do conteúdo (acesso público)
- [x] Listagem de conteúdos (acesso público)
- [x] Criação e edição de conteúdos (posts) com os título, corpo e path  (acesso restrito)

## Demonstração

Disponibilizei uma versão instalada de testes neste link: [cmsjust.brunomonteirogomes.com.br](http://cmsjust.brunomonteirogomes.com.br/)


## Bibliotecas PHP utilizadas:

- [Whoops](http://github.com/filp/whoops): Tratamento de Erros
- [Auryn](http://github.com/rdlowrey/auryn): Injetor de Dependências
- [FastRoute](http://github.com/nikic/FastRoute): Roteador
- [Twig](http://github.com/twigphp/Twig): Template Engine
- [patricklouys/http](http://github.com/patricklouys/http): Abstração Http orientada à objetos
- [delight-im/auth](http://github.com/delight-im/PHP-Auth): Authentication
- [plasticbrain/php-flash-messages](http://github.com/plasticbrain/php-flash-messages): Flash messages

## Bibliotecas FrontEnd

- [Bulma](https://github.com/jgthms/bulma): Framework CSS
- [jQuery](https://github.com/jquery/jquery): Biblioteca JS
- [Webpack](https://github.com/webpack): Module Bundler
- [Laravel Mix](https://github.com/JeffreyWay/laravel-mix): Api para o Webpack

## Testes Funcionais

Foram definidos 14 cenários e 68 definições para o sistema.

As features estão definidas em /features.

![Resultados dos testes](http://cmsjust.brunomonteirogomes.com.br/imgs/tests_result.png "Resultados dos testes")

## Instalação

1. Clonar repositório
  ```
  mkdir seudiretorio
  git clone https://github.com/bmonteirog/cms-sem-framework.git ./seudiretorio
  ```

2. Baixar dependências com o Composer
  ```
  composer update
  ```

3. Instalar a base de dados (substituindo o host, o user e o DBNAME pelos apropriados)
  ```
  mysql -h host -u user -p
  CREATE DATABASE DBNAME;
  exit;
  mysql -u host -p DBNAME < dbdump.sql
  ```

4. Configurar acesso à base no arquivo `config/database.php`

4. Criar um servidor virtual para hospedar o sistema e poder rodar os testes. (instruções para servidores Apache)

  Adicione esta linha ao arquivo `/etc/hosts`:
  ```
  127.0.0.1 seudominio
  ```

  E adicione este bloco no arquivo `/etc/apache2/sites-enabled/000-default.conf`, apontado para o diretório /public do sistema:
  ```
  <VirtualHost *:80>
  	ServerName seudominio
  	DocumentRoot /caminho/para/a/pasta/public/
  	<Directory "/caminho/para/a/pasta/public/">
  	    Options FollowSymLinks
  	    AllowOverride All
  	</Directory>
  </VirtualHost>
  ```

  Feito isso, reinicie o Apache:
  ```
  sudo /etc/init.d/apache2 restart
  ```

5. Rodar testes

  Configure o domínio de testes no arquivo `behat.yaml` (linha 9)
  ```
  base_url: http://seudominio
  ```

  E também na linha 80 do arquivo `/features/bootstrap/FeatureContext`
  ```
  $session->visit('http://seudominio/login');
  ```

  Feito isso, basta rodar o behat:
  ```
  vendor/bin/behat
  ```
