<?php
/*
* Plugin Name:          Gerenciador de Avaliações
* Description:          Plugin para avaliação de especialistas.
* Author:               Gabriel Souza | Mlovi Desenvolvimento e Soluções
* Author URI:           https://mlovi.com.br/
* Version:              1.0.0
* License: 						 GPLv3
* License URI: 				 http://www.gnu.org/licenses/gpl-3.0.html
* Text Domain:          gerenciador_de_avaliacoes
*/



/*ALWAYS SET PREFIX WITH PLUGIN NAME FIRST LETTERS OF EACH WORD. (ex.: Gerenciador de Avaliações = GDA   ->   gda_path, gda_url) */

defined('ABSPATH') or die("You can't acess directly");

if(file_exists((dirname(__FILE__) . '/vendor/autoload.php'))){
    require_once((dirname(__FILE__) . '/vendor/autoload.php'));
}

/*
**Define main path and url
*/
define( 'GDA_BASENAME', plugin_basename(__FILE__));
define( 'GDA_PATH', plugin_dir_path((__FILE__)));
define( 'GDA_URL', plugin_dir_url(__FILE__));


use Inc_GDA\Base\Activate;
use Inc_GDA\Base\Deactive;

function activate_gda_plugin(){
    Activate::activate();
}

function deactivate_gda_plugin(){
    Deactive::deactivate();
}

register_activation_hook(__FILE__, 'activate_gda_plugin');
register_deactivation_hook(__FILE__, 'deactivate_gda_plugin');




if(class_exists('Inc_GDA\\Init')){
    Inc_GDA\Init::register_services();
}
