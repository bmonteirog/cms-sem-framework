<?php declare(strict_types = 1);

error_reporting(E_ALL);

/**
* CMS de teste sem Framework
*
* @package CMS
* @author Bruno Monteiro <bmonteirog@gmail.com>
*/

/*
| O Arquivo index.php, é o ponto de entrada para a aplicação.
| Com exceção dos assets, vai ser o único arquivo de acesso público.
*/

/*
|--------------------------------------------------------------------------
| Incluindo o arquivo de Bootstrap
|--------------------------------------------------------------------------
|
| O arquivo de Bootstrap vai ser o responsável por integrar todas as partes
| da aplicação.
|
*/
require __DIR__ . '/../src/Bootstrap.php';
