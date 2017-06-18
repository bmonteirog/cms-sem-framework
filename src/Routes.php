<?php declare(strict_types = 1);

/*
|--------------------------------------------------------------------------
| Registrando as Rotas da Aplicação
|--------------------------------------------------------------------------
|
| Aqui vamos definir as rotas disponíveis na nossa aplicação, assim como
| o método HTTP no qual ela responde (GET, POST, PUT, PATCH, DELETE ou HEAD)
| e retornar um array com todas as definições para o Bootstrap.php.
|
*/

return [
    ['GET', '/', function () {
        echo 'Tudo funcionando :)';
    }]
];
