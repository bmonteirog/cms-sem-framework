<?php declare(strict_types = 1);

/*
|--------------------------------------------------------------------------
| Definindo o Namespace da aplicação
|--------------------------------------------------------------------------
*/
namespace CMS;

/*
|--------------------------------------------------------------------------
| Registrando o Autoloader do Composer
|--------------------------------------------------------------------------
|
| O arquivo de autoload do composer vai ser o responsável por incluir
| todas as bibliotecas utilizadas na aplicação.
|
*/
require __DIR__ . '/../vendor/autoload.php';


/*
|--------------------------------------------------------------------------
| Registrando o Tratador de Erros
|--------------------------------------------------------------------------
|
| O error handler vai ser responsável por exibir interfaces de erro amigáveis
| (aos devs) para acelerar o desenvolvimento. O handler em um ambiente de
| produção deveria encaminhar um e-mail para o responsável do projeto ou
| armazenar em um log.
|
| Biblioteca utilizada: Whoops <https://github.com/filp/whoops>
|
*/
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


/*
|--------------------------------------------------------------------------
| Registrando o Injetor de Dependência
|--------------------------------------------------------------------------
|
| O injetor resolve as dependências das classes e injeta os objetos corretos
| quando uma classe é instanciada. Vamos definir as dependências em um arquivo
| à parte, o Dependencies.php
|
| Biblioteca utilizada: Auryn <https://github.com/rdlowrey/auryn>
|
*/
$injector = include('Dependencies.php');


/*
|--------------------------------------------------------------------------
| Instanciando a Requisição e a Resposta
|--------------------------------------------------------------------------
|
| Vamos criar dois objetos através do injetor. Um para tratar a requisição e
| outro para tratar a resposta do servidor.
|
| Estou utilizando uma biblioteca para lidar com a camada HTTP de maneira
| orientada à objetos.
|
| Biblioteca utilizada: Http Component <https://github.com/PatrickLouys/http>
|
*/
$request  = $injector->make('Http\Request');
$response = $injector->make('Http\Response');


/*
|--------------------------------------------------------------------------
| Roteando as requisições
|--------------------------------------------------------------------------
|
| Aqui vamos apontar as requisições que chegam à aplicação para os métodos
| correspondentes utilizando uma classe de Roteamento. As definições de
| rota vão ficar armazenadas em seu arquivo próprio, o Routes.php
|
| Biblioteca utilizada: FastRoute <https://github.com/nikic/FastRoute>
|
*/

/*
| Aqui vamos criar um método Callback que inclui o arquivo de rotas
| linha a linha e vamos passá-lo para o Dispatcher:
*/
$routesCallback = function (\FastRoute\RouteCollector $r) {
  $routes = include('Routes.php');
  foreach ($routes as $route)
    $r->addRoute($route[0], $route[1], $route[2]);
};
$dispatcher = \FastRoute\simpleDispatcher($routesCallback);

/*
| Aqui vamos resolver a rota de acordo com o método e o path:
*/
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

/*
| Aqui vamos analisar a resposta do Roteador e mostrar o conteúdo apropriado.
| Em ambiente de produção as respostas de erro deveriam mostrar uma tela
| amigável ao usuário. Para efeitos de sistema de testes vamos apenas apresentar
| uma resposta em texto plano.
*/
switch ($routeInfo[0]) {

  case \FastRoute\Dispatcher::NOT_FOUND:
    /*
    * Página não encontrada, retornar status 404
    */
    $response->setContent('404 - Page not found');
    $response->setStatusCode(404);
    break;

  case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    /*
    * Método não permitido, retornar status 405
    */
    $response->setContent('405 - Method not allowed');
    $response->setStatusCode(405);
    break;

  case \FastRoute\Dispatcher::FOUND:
    /*
    * Método correto e rota encontrada, retornar status 200 e
    * chamar a classe apropriada:
    */
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];
    call_user_func($handler, $vars);
    break;
}

/*
|--------------------------------------------------------------------------
| Enviando a Resposta ao navegador
|--------------------------------------------------------------------------
|
| Para devolver o conteúdo para o navegador precisamos primeiro enviar
| todo os cabeçalhos HTTP e em seguida o conteúdo.
|
*/
foreach ($response->getHeaders() as $header)
  header($header, false);

echo $response->getContent();
