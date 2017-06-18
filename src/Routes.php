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
    // Rotas públicas
    ['GET', '/', ['CMS\Controllers\Homepage', 'index']],
    ['GET', '/posts/{slug}', ['CMS\Controllers\Homepage', 'show']],

    ['GET', '/login', ['CMS\Controllers\Auth', 'login']],
    ['POST', '/login', ['CMS\Controllers\Auth', 'postLogin']],
    ['GET', '/logout', ['CMS\Controllers\Auth', 'logout']],

    // Rotas restritas
    ['GET', '/admin', ['CMS\Controllers\Admin', 'show']],

    ['GET', '/admin/posts', ['CMS\Controllers\Admin\Post', 'index']],
    ['GET', '/admin/posts/create', ['CMS\Controllers\Admin\Post', 'create']],
    ['POST', '/admin/posts/save', ['CMS\Controllers\Admin\Post', 'save']],
    ['GET', '/admin/posts/edit/{post_id}', ['CMS\Controllers\Admin\Post', 'edit']],
    ['POST', '/admin/posts/update/{post_id}', ['CMS\Controllers\Admin\Post', 'update']],
    ['GET', '/admin/posts/delete/{post_id}', ['CMS\Controllers\Admin\Post', 'destroy']],
];
