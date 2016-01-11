<?php
session_start();

require_once( FC_PATH.'vendor'.DS.'autoload.php' );

//use Facebook\FacebookSession;
//use Facebook\FacebookRedirectLoginHelper;
//use Facebook\FacebookRequest;

class Twfcfacebook{
    
    public function postFacebook($array = array()) 
    {
        // pega os dados do facebook  
        $optionApp = get_option('twfc_app');                 
        
        $fb = new Facebook\Facebook([
            'app_id' => $optionApp['facebookappid'],
            'app_secret' => $optionApp['facebookappsecret'],
            'default_graph_version' => 'v2.2',                
        ]);
        
        // pega o token salvo 
        $access_token = get_option('twfcfacebook_token'); 
        
        $linkData = array(
            'name'          => $array['titulo'],
            'caption'       => $array['url'],
            'link'          => $array['url'],
            //'message' => 'Verificando integração entre Facebook e o website.',
            'picture'       => $array['imagem'],
            'description'   => $array['conteudo']
        );
        
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->post('/me/feed', $linkData, $access_token['fb_token']);
            
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
            
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
            
        }
        
        $graphNode = $response->getGraphNode();
        
        return $graphNode;
    }
    
}