const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*
| Copiando os arquivos de Vendor para a pasta de assets
*/
//mix.copy('node_modules/bulma/css/bulma.css', 'assets/');
//mix.copy('node_modules/jquery/dist/jquery.js', 'assets/');

/*
| Aqui vamos:
| Compilar o arquivo .less e enviando para /public
| Concatenar os scripts e enviar para /public
*/
mix.less('assets/app.less', 'public/css')
   .scripts([
     'node_modules/jquery/dist/jquery.js',
     'assets/main.js'
   ], 'public/js/main.js');
