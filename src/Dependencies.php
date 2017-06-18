<?php declare(strict_types = 1);

// Criando a instância do Injetor
$injector = new \Auryn\Injector;

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

/*
|--------------------------------------------------------------------------
| Definindo os Parâmetros
|--------------------------------------------------------------------------
|
| Podemos especificar aqui quais os parâmetros devem ser passados aos
| construtores das classes que estamos compartilhando.
|
*/
$injector->define('Http\HttpRequest', [
  ':get' => $_GET,
  ':post' => $_POST,
  ':cookies' => $_COOKIE,
  ':files' => $_FILES,
  ':server' => $_SERVER,
]);

// Retornando a instância do nosso Injetor para o Bootstrap.php
return $injector;
