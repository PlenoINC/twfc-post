<?php
session_start();

require_once( FC_PATH.'vendor'.DS.'autoload.php' );

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

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
        if( isset($optionApp['facebookappid']) and $optionApp['facebookappsecret'] ){
            
            // url de retorno
            $redirect_uri = admin_url('admin.php?page=twfc-post');
            
            // Solicitação de permissão do app - opicional
            
            $permissions = array(
                'email',
                'user_location',
                'user_birthday'
            );
          
            
            // inciando o SDK
            FacebookSession::setDefaultApplication( $optionApp['facebookappid'], $optionApp['facebookappsecret'] );
                    
                    // Criar o ajudante login e substituir REDIRECT_URI com a sua URL
                    // Use o mesmo domínio que você definiu para os aplicativos 'App Domains'
                    // Exemplo $ ajudante = new FacebookRedirectLoginHelper ('http://mydomain.com/redirect');                    
                    $helper = new FacebookRedirectLoginHelper( $redirect_uri );
                    
                    // Verifica se existe sessao
                    if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
                        
                        // cria nova sessao access_token
                        $session = new FacebookSession( $_SESSION['fb_token'] );
                        
                        // valida access_token para certificar validade
                        try {
                            if ( ! $session->validate() ) { 
                                $session = null;
                            }
                        } catch ( Exception $e ) {
                            // Capturar quaisquer exceções
                            $session = null;
                        }
                    } else {
                        // Nao existe sessao
                        try {
                            $session = $helper->getSessionFromRedirect();
                            } catch( FacebookRequestException $ex ) {
                                // quando Facebook retornar erro
                            } catch( Exception $ex ) {
                                // Quando a validação falhar ou outras questões locais
                                echo $ex->getMessage();
                            }                   
                        }
                    }
                   
                    // verifica se existe sessao
                    if ( isset( $session ) ) {
                        
                        // Salva sessao
                        $_SESSION['fb_token'] = $session->getToken();
                        
                        //Criar sessão usando o token salvo ou gera nova sessão
                        $session = new FacebookSession( $session->getToken() );
                        
                        // Create the logout URL (logout page should destroy the session)
                        $logoutURL = $helper->getLogoutUrl( $session, $redirect_uri );
                        
                        update_option('twfc_login_facebook', array(
                            'btnfacebook' => '<a class="button-secondary" href="' . $logoutURL . '">Cancelar Auto Publicação</a>'
                            )
                        );
                        
                        unset($_SESSION['fb_token']);
                        
                    } else {
                        // se não existir sessao
                        $loginUrl = $helper->getLoginUrl( $permissions );
                        
                        update_option('twfc_login_facebook', array(
                            'btnfacebook' => '<a class="button-primary" href="' . $loginUrl . '">Autoriazar Auto Publicação</a>'
                            )
                        );
                    }
                    if($_SESSION['fb_token']){
                        update_option('twfcfacebook_token', array(
                            'fb_token' => $_SESSION['fb_token']
                                )
                        );
                    }
            
        
            
        
    }
}



