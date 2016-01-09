<?php
/**
 * Este arquivo é parte do plugin TWFC-Post.
 * (c) Reinaldo Rodrigues <contato@reinaldorodrigues.com.br>  * 
 * 
 */
 global $post, $wpdb, $idHop;   


 $url        = 'admin.php?page=twfc-post'
?>
<div class="wrap">
    
    <div id="poststuff">
        
        <div id="post-body" class="metabox-holder">
            
            <div id="post-body-content">
                
                <h2>TWFC POST - Postagerm automática no Twitter e Facebbok</h2>
                
                <form method="post" action="<?php echo $url; ?>" id="addimage" name="addimage"  enctype="multipart/form-data" encoding="multipart/form-data">
                    <?php
                    require_once VIEWS_PATH.'facebook.php';
                    require_once VIEWS_PATH.'twitter.php';    
                    ?>
                </form>
                
            </div>
            
        </div>
        
    </div>
    
</div>
