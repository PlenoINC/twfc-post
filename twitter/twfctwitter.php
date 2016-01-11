<?php

require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

class Twfctwitter{
    
    public function postTwitter($array)
    {
        $optionAppTwitter = get_option('twfc_app_twitter');
        
        // realiza a conexão com o twiiter
        $connection = new TwitterOAuth($optionAppTwitter['twitterconsumer'], $optionAppTwitter['twitterconsumersecret'], $optionAppTwitter['twitteraccesstoken'], $optionAppTwitter['twitteraccesstokensecret']);
        $content = $connection->get("account/verify_credentials");
        
        if(isset($content)){
            
            if($array['imagem']){
                
                $media = $connection->upload('media/upload', array('media' => $array['imagem']));
                $parameters = array(
                    'status' => $array['titulo'],
                    'media_ids' => $media1->media_id_string
                );
            }else{
                $parameters = array(
                    'status' => $array['titulo']
                );
            }
            $result = $connection->post('statuses/update', $parameters);
            
            return $result;
        }

    }
    
}