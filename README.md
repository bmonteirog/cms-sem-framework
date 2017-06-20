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
