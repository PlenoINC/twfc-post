<?php
session_start();

require_once( FC_PATH.'vendor'.DS.'autoload.php' );

//use Facebook\FacebookSession;
//use Facebook\FacebookRedirectLoginHelper;
//use Facebook\FacebookRequest;

class Requests{
    
    private $btn_save;
    private $facebook_appid;
    private $facebook_appsecret;
    private $twitter_accesstoken;
    private $twitter_accesstokensecret;
    private $twitter_consumerkey;
    private $twitter_consumersecret;
    private $fbcallback;
    private $error;
            
    
    function __construct() 
    {
        $this->btn_save                     = $_POST['save'] ? $_POST['save'] : NULL;
        $this->facebook_appid               = addslashes(strip_tags($_POST['facebookappid']));
        $this->facebook_appsecret           = addslashes(strip_tags($_POST['facebookappsecret']));
        $this->twitter_accesstoken          = addslashes(strip_tags($_POST['twitteraccesstoken']));
        $this->twitter_accesstokensecret    = addslashes(strip_tags($_POST['twitteraccesstokensecret']));
        $this->twitter_consumerkey          = addslashes(strip_tags($_POST['twitterconsumerkey']));
        $this->twitter_consumersecret       = addslashes(strip_tags($_POST['twitterconsumersecret']));
        $this->fbcallback                   = $_GET['fbcallback'];
        $this->error                        = FALSE;
    }
    
    function varPost()
    {
        
        global $btnFace;
        
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
                // salva/atualiza os registros
                update_option('twfc_app', array(
                    'facebookappid'             => $this->facebook_appid,
                    'facebookappsecret'         => $this->facebook_appsecret,
                    'twitteraccesstoken'        => $this->twitter_accesstoken,
                    'twitteraccesstokensecret'  => $this->twitter_accesstokensecret,
                    'twitterconsumer'           => $this->twitter_consumerkey,
                    'twitterconsumersecret'     => $this->twitter_consumersecret                    
                    )
                );
                
                // mensagem 
                update_option('twfc_messages', array(
                    'tipo'=>'sucesso',
                    'mensagem' => 'Dados salvo com sucesso!'
                    )
                );
                                   
            }
            
        }

        // pega os registros do facebook
        $optionApp = get_option('twfc_app'); 
                
        
        // se existir os dados da app do facebook faz a conecsão
        if( isset($optionApp['facebookappid']) and $optionApp['facebookappsecret'] and $this->fbcallback == ''  ){
            
            // url de retorno
            $redirect_uri = admin_url('admin.php?page=twfc-post&fbcallback=call');
            
            // Solicitação de permissão do app - opicional
            
            $permissions = array(
                'email',
                'user_location',
                'user_birthday',
                'publish_actions'
            );
            
            $fb = new Facebook\Facebook([
                'app_id' => $optionApp['facebookappid'],
                'app_secret' => $optionApp['facebookappsecret'],
                'default_graph_version' => 'v2.2',                
            ]);
            
            $helper = $fb->getRedirectLoginHelper();
            
            $loginUrl = $helper->getLoginUrl($redirect_uri, $permissions);
            
            update_option('twfc_login_facebook', array(
                'btnfacebook' => '<a class="button-primary" href="' . $loginUrl . '">Autoriazar Auto Publicação</a>'
                )
            );        
        }
        
        if($this->fbcallback){
            
            $fb = new Facebook\Facebook([
                'app_id' => $optionApp['facebookappid'],
                'app_secret' => $optionApp['facebookappsecret'],
                'default_graph_version' => 'v2.2',                
            ]);
            
            $helper = $fb->getRedirectLoginHelper();
            
            try {
                $accessToken = $helper->getAccessToken();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
            }

            if (! isset($accessToken)) {
              if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
              } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
              }
              exit;
            }else{
                 update_option('twfcfacebook_token', array(
                    'fb_token'             => $accessToken->getValue()
                   )
                );
            }
            
            
        }
        
    }
}



