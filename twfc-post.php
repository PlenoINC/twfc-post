<?php
session_start();
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



function action_twfc() 
{
    global $post, $wpdb;   
    
    // incluir o arquivo que trata 
    // as requisições do formulario
    require_once TWFC_PATH.DS.'requests.php';
    
    
    $form = new Requests();
    $form->varPost();
    
    // incluir o arquivo com o formulario 
    require_once VIEWS_PATH.'default.php';
    
    
}

function auto_post_twfc($post_ID)  {
    
    $post_title         = get_the_title( $post_ID ); // titulo do post
    $post_url           = get_permalink( $post_ID ); // url da post        
    $redirect_uri       = get_edit_post_link(); // url de retorno / url do post
    
    // Imagem usada na postagem das redes sociais
    $imgRedes           = get_post_meta( $post_ID, 'imagemredes',true ) ? get_post_meta( $post_ID, 'imagemredes',true ) : urlBase().'/images/banners/posts/banner_post_redes.jpg';
    
    // pega os dados do post
    $postpp             = get_post($post_ID);
    $post_description   = strip_tags($postpp->post_content); // conteudo do post
    
    // inclui o arquivo para iniciar as classes facebook
    require_once FC_PATH.'twfcfacebook.php';
    
    $postFace = new Twfcfacebook();
    
    $array = array(
        'titulo'        => $post_title,
        'url'           => $post_url,
        'redirect'      => $redirect_uri,
        'imagem'        => $imgRedes,
        'conteudo'      => $post_description
        
    );
    
   $return = $postFace->postFacebook($array);
   
   var_dump($return);   
    
}

add_action ( 'publish_post', 'auto_post_twfc' ); //should trigger function on publish post