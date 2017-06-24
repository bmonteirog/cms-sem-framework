<?php declare(strict_types = 1);

// Criando a instância do Injetor
$injector = new \Auryn\Injector;

/*
|--------------------------------------------------------------------------
| Registrando a abstração da Base de Dados
|--------------------------------------------------------------------------
|
| A classe de abstração da base de dados vai ser responsável por conectar
| e realizar todas as operações relacionadas à base de dados da aplicação
|
*/
$dbconfig = include('../config/db.php');
$pdo = new PDO('mysql:host='.$dbconfig['host'].';dbname='.$dbconfig['database'].';charset=utf8', $dbconfig['username'], $dbconfig['password']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$injector->share($pdo);

/*
|--------------------------------------------------------------------------
| Registrando os Alias
|--------------------------------------------------------------------------
|
| O método Alias nos permite definir qual Classe deve ser Instanciada quando
| uma determinada Interface é requisitada.
|
| E.g. vamos instanciar um objeto Http\HttpRequest sempre que uma interface
| Http\Request for solicitada no construtor das classes.
|
*/
$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->alias('CMS\Template\Renderer', 'CMS\Template\TwigRenderer');


/*
|--------------------------------------------------------------------------
| Compartilhando as instâncias
|--------------------------------------------------------------------------
|
| O método share nos permite utilizar o mesmo objeto instanciado por toda
| a nossa aplicação.
|
*/
$injector->share('Http\HttpRequest');
$injector->share('Http\HttpResponse');
$injector->share('PDO');
$injector->share('CMS\Models\PostModel');

/*
|--------------------------------------------------------------------------
| Definindo os Parâmetros
|--------------------------------------------------------------------------
|
| Podemos especificar aqui quais os parâmetros devem ser passados aos
| construtores das classes que estamos compartilhando.
|
*/
$injector->define('Delight\Auth\Auth', [':databaseConnection' => $pdo]);
$injector->define('Http\HttpRequest', [
  ':get' => $_GET,
  ':post' => $_POST,
  ':cookies' => $_COOKIE,
  ':files' => $_FILES,
  ':server' => $_SERVER,
]);


/*
|--------------------------------------------------------------------------
| Delegando a criação da classe para um método anônimo
|--------------------------------------------------------------------------
|
| Como a instanciação do Twig precisa ser alimentada com os arquivos
| disponíveis na pasta /templates, vamos criar uma função que leia
| esse diretório e alimente a classe.
|
*/
$injector->delegate('Twig_Environment', function () use ($injector) {
  $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
  $twig = new Twig_Environment($loader);
  return $twig;
});

/*
|--------------------------------------------------------------------------
| Instanciando o Model e compartilhando pela aplicação
|--------------------------------------------------------------------------
*/
$postModel = $injector->make('CMS\Models\PostModel', [$pdo]);
$injector->share('CMS\Models\PostModel');

// Retornando a instância do nosso Injetor para o Bootstrap.php
return $injector;
