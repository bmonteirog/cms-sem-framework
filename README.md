# CMS de testes sem Framework

Sistema de gerenciamento de conteúdo de testes desenvolvido sem utilizar frameworks.

- [x] Sistema de login
- [x] Visualização do conteúdo (acesso público)
- [x] Listagem de conteúdos (acesso público)
- [x] Criação e edição de conteúdos (posts) com os título, corpo e path  (acesso restrito)

## Demonstração

Disponibilizei uma versão instalada de testes neste link: [cmsjust.brunomonteirogomes.com.br](http://cmsjust.brunomonteirogomes.com.br/)


## Bibliotecas PHP utilizadas:

- filp/whoops: Tratamento de Erros
- rdlowrey/auryn: Injetor de Dependências
- patricklouys/http: Abstração Http orientada à objetos
- nikic/fast-route: Roteador
- twig/twig: Template Engine
- delight-im/auth: Authentication
- plasticbrain/php-flash-messages: Flash messages

## Bibliotecas FronEnt

- Bulma: Framework CSS
- jQuery: Biblioteca JS
- Webpack: Module Bundler
- Laravel Mix: Api para o Webpack

## Testes Funcionais

Foram definidos 14 cenários e 68 definições para o sistema.

As features estão definidas em /features.

![Resultados dos testes](http://cmsjust.brunomonteirogomes.com.br/imgs/tests_result.png "Resultados dos testes")
