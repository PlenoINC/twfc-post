<?php
/**
 * Este arquivo é parte do plugin TWFC-Post.
 * (c) Reinaldo Rodrigues <contato@reinaldorodrigues.com.br>  * 
 * 
 */
global $post, $wpdb, $idHop;   

// pega a mensagem salva
$messages = get_option('twfc_messages'); 
if(isset($messages['tipo']) and $messages['mensagem']!=""){
    $tipo       = $messages['tipo'];
    $message    = $messages['mensagem'];
} 
 
$optionApp = get_option('twfc_app');  
 
$fc_appid                = $optionApp['facebookappid'] ? $optionApp['facebookappid'] : '';
$fc_appsecret            = $optionApp['facebookappsecret'] ? $optionApp['facebookappsecret'] : '' ;
$tw_accesstoken           = $optionApp['twitteraccesstoken'] ? $optionApp['twitteraccesstoken'] : '' ;
$tw_accesstokensecret     = $optionApp['twitteraccesstokensecret'] ? $optionApp['twitteraccesstokensecret'] : '';
$tw_consumerkey           = $optionApp['twitterconsumer'] ? $optionApp['twitterconsumer'] : '';
$tw_consumersecret        = $optionApp['twitterconsumersecret'] ? $optionApp['twitterconsumersecret'] : '';

$url        = 'admin.php?page=twfc-post'
?>
<div class="wrap">
    <?php
    //mostra a mensagem
    if($tipo == 'erro'){         
        echo '<div id="message" class="error"><p>'.$message.'</p><br /></div>';            
    }
    if($tipo == 'sucesso'){ 
        echo '<div id="message" class="updated below-h2"><p>'.$message.'</p></div>';        
    }
    // atualiza a mensagem apagando o que existir
    update_option('twfc_messages', array()); 
    ?>
    <div id="poststuff">
        
        <div id="post-body" class="metabox-holder">
            
            <div id="post-body-content">
                
                <h2>TWFC POST - Postagerm automática no Twitter e Facebbok</h2>
                
                <form method="post" action="<?php echo $url; ?>" id="addimage" name="addimage"  enctype="multipart/form-data" encoding="multipart/form-data">
                    <?php
                    require_once VIEWS_PATH.'facebook.php';
                    require_once VIEWS_PATH.'twitter.php';    
                    ?>
                    <input type="submit" name="save" id="btnsave" value="Salvar" class="button-primary" />   
                </form>
                
            </div>
            
        </div>
        
    </div>
    
</div>
