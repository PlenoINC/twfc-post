<?php
class Requests{
    
    private $btn_save;
    private $facebook_appid;
    private $facebook_appsecret;
    private $twitter_accesstoken;
    private $twitter_accesstokensecret;
    private $twitter_consumerkey;
    private $twitter_consumersecret;
    private $error;
            
    
    function __construct() 
    {
        $this->btn_save                     = $_POST['save'] ? $_POST['save'] : NULL;
        $this->facebook_appid               = addslashes(strip_tags($_POST['facebookappid']));
        $this->facebook_appsecret           = addslashes(strip_tags($_POST['facebookappsecret']));
        $this->twitter_accesstoken           = addslashes(strip_tags($_POST['twitteraccesstoken']));
        $this->twitter_accesstokensecret     = addslashes(strip_tags($_POST['twitteraccesstokensecret']));
        $this->twitter_consumerkey          = addslashes(strip_tags($_POST['twitterconsumerkey']));
        $this->twitter_consumersecret       = addslashes(strip_tags($_POST['twitterconsumersecret']));
        $this->error                        = FALSE;
    }
    
    function varPost()
    {
        if($this->btn_save){
            
            // array com todos os dados 
            // do formulario e nome do campo
            $campos = array(
                'Facebook App Id'               => $this->facebook_appid,
                'Facebook App Secret'           => $this->facebook_appsecret,
                'Twitter Access Token'          => $this->twitter_accesstoken,
                'Twitter Access Token Secret'   => $this->twitter_accesstokensecret,
                'Twitter Consumer Key'          => $this->twitter_consumerkey,
                'Twitter Consumer Secret'       => $this->twitter_consumersecret 
            );
            
            // percorre todo o array e valida os dados
            foreach ($campos as $cp => $dados) {
                
                // se os dados for nulo ou em branco salva em option a 
                // mensagem de erro e seta a variavel error para true
                if($dados == null || $dados == ''){
                    
                    update_option('twfc_messages', array(
                        'tipo'=>'erro',
                        'mensagem' => $cp.' é de preenchimento obrigatório!'
                        )
                    );
                    
                    $this->error = TRUE;
                    
                    break;
                }
            }
            
            // se não existir erro salva/atualiza os dados do formulario 
            if(!$this->error){
              
                update_option('twfc_app', array(
                    'facebookappid'             => $this->facebook_appid,
                    'facebookappsecret'         => $this->facebook_appsecret,
                    'twitteraccesstoken'        => $this->twitter_accesstoken,
                    'twitteraccesstokensecret'  => $this->twitter_accesstokensecret,
                    'twitterconsumer'           => $this->twitter_consumerkey,
                    'twitterconsumersecret'     => $this->twitter_consumersecret                    
                    )
                );
                
                update_option('twfc_messages', array(
                    'tipo'=>'sucesso',
                    'mensagem' => 'Dados salvo com sucesso!'
                    )
                );
            }
            
        }else{
            return;
        }
            
        
    }
}



