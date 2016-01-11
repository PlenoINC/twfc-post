<?php
/**
 * Este arquivo é parte do plugin TWFC-Post.
 * (c) Reinaldo Rodrigues <contato@reinaldorodrigues.com.br>  * 
 * 
 */
$url        = 'admin.php?page=twfc-post';
?>
<form method="post" action="<?php echo $url; ?>" id="addimage" name="addimage"  enctype="multipart/form-data" encoding="multipart/form-data">
<div class="stuffbox" id="namediv" style="width:100%;">
    <div class="inside">
        <h2>Facebook</h2>
        <table class="form-table">
            <tbody>
                <tr>
                    <th style="width: 20%;">
                        <label for="aecfacebookappid">App ID:</label>
                    </th>
                    <td>
                        <input type="text" name="facebookappid" id="appid" value="<?php echo stripslashes($fc_appid); ?>" size="50" />                                        
                    </td>
                    <td/>
                </tr>
                <tr>
                    <th style="width: 20%;">
                        <label for="aecfacebookappsecret">App Secret:</label>
                    </th>
                    <td>
                        <input type="text" name="facebookappsecret" id="appsecret" value="<?php echo stripslashes($fc_appsecret); ?>" size="50" />
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" name="save" id="btnsave" style="width: 150px; margin-right: 15px;"  value="Salvar" class="button-primary" />
         <?php 
         $optionFace = get_option('twfc_login_facebook'); 
         if($optionFace['btnfacebook']){
             echo $optionFace['btnfacebook'];
         }
         ?>
    </div>
</div>
     
    <input type="hidden" name="action" value="form-facebook" />
      
</form>