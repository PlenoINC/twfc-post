<?php
/*
Plugin Name: TWFC Post
Plugin URI: http://www.reinaldorodrigues.com.br/wordpress/plugin/twfc-post
Description: Plugin do Wordpress para inserir recaptcha no formulario 
Version: 1.0.0
Author: Reinaldo Rodrigues
Author URI:  http://www.reinaldorodrigues.com.br/sobre/
License: GPLv2
*/

define('TWFC_PATH',dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('FC_PATH', TWFC_PATH.DS.'facebook'.DS);
define('TW_PATH', TWFC_PATH.DS.'twitter'.DS);
define('VIEWS_PATH', TWFC_PATH.DS.'views'.DS);



// adicionar o plugin no menu
add_action('admin_menu', 'add_admin_menu_twfc');

function add_admin_menu_twfc(){    
    $icon = plugins_url( 'rrcommentrecaptcha'.DS.'assets'.DS.'images'.DS.'icon.png' );
    add_menu_page( 'TWFC Post','TWFC Post', 'administrator', 'twfc-post','action_twfc', $icon );
}



function action_twfc($param) {
    
    // incluir o arquivo com o formulario 
    require_once VIEWS_PATH.'default.php';
    
}