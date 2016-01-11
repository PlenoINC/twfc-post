<?php
session_start();

require_once( FC_PATH.'vendor'.DS.'autoload.php' );

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

class Twfcfacebook{
    
    public function postFacebook($array = array()) 
    {
        // pega os dados do facebook  
        $optionApp = get_option('twfc_app');                 
        
        // inciando o SDK
        FacebookSession::setDefaultApplication($optionApp['facebookappid'], $optionApp['facebookappsecret']);
        
        // url de retorno
        $redirect_uri = admin_url('admin.php?page=twfc-post');
        $helper = new FacebookRedirectLoginHelper( $redirect_uri );
        
        // pega o token salvo 
        $sessionApp = get_option('twfcfacebook_token'); 
        
        
        if(isset($sessionApp['fb_token']) ){
            $token = $sessionApp['fb_token'];
        }
        
        
        $session = new FacebookSession( $token );
        
        // Validar o token de acesso para se certificar de que ainda é válido
        try {
            if ( ! $session->validate() ) {
                $session = null;
            }
        } catch ( Exception $e ) {
            // Capturar quaisquer exceções
            $session = null;
        }
        
        // Check if a session exists
        if ( isset( $session ) ) {
           
            // Graph API para publicar em linha do tempo com parâmetros adicionais
            $request = (new FacebookRequest( $session, 'POST', '/me/feed', array(
                'name'          => $array['titulo'],
                'caption'       => $array['url'],
                'link'          => $array['url'],
                //'message' => 'Verificando integração entre Facebook e o website.',
                'picture'       => $array['imagem'],
                'description'   => $array['conteudo']
             )))->execute();
            
            // Obter resposta como uma matriz, retorna ID de pós
            $response = $request->getGraphObject()->asArray();
        }  else {
            
        }
        
        return $response;
    }
    
}