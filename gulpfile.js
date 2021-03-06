var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less(['app.less', 'libraries']);
    mix.scriptsIn("resources/assets/js/libraries", "public/js/libraries.js");
    mix.scriptsIn("resources/assets/js/app", "public/js/main.js");
});
