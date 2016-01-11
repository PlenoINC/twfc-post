<?php
/**
 * Este arquivo é parte do plugin TWFC-Post.
 * (c) Reinaldo Rodrigues <contato@reinaldorodrigues.com.br>  * 
 * 
 */
?>
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
        
         <?php 
         $optionFace = get_option('twfc_login_facebook'); 
         if($optionFace['btnfacebook']){
             echo $optionFace['btnfacebook'];
         }
         ?>
    </div>
</div>