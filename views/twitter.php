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
        <h2>Twitter</h2>
        <table class="form-table">
            <tbody>
                <tr>
                    <th style="width: 20%;">
                        <label for="twitteracesstoken">Access Token:</label>
                    </th>
                    <td>
                        <input type="text" name="twitteraccesstoken" id="twitteraccesstoken" value="<?php echo stripslashes($tw_accesstoken); ?>" size="50" />                                        
                    </td>
                    <td/>
                </tr>
                <tr>
                    <th style="width: 20%;">
                        <label for="twitteraccesstokensecret">Acess Token Secret:</label>
                    </th>
                    <td>
                        <input type="text" name="twitteraccesstokensecret" id="twitteraccesstokensecret" value="<?php echo stripslashes($tw_accesstokensecret); ?>" size="50" />
                    </td>
                </tr>
                <tr>
                    <th style="width: 20%;">
                        <label for="twitterconsumerkey">Consumer Key:</label>
                    </th>
                    <td>
                        <input type="text" name="twitterconsumerkey" id="twitterconsumerkey" value="<?php echo stripslashes($tw_consumerkey); ?>" size="50" />
                    </td>
                </tr>
                <tr>
                    <th style="width: 20%;">
                        <label for="twitterconsumersecret">Consumer Secret:</label>
                    </th>
                    <td>
                        <input type="text" name="twitterconsumersecret" id="twitteracesstokensecret" value="<?php echo stripslashes($tw_consumersecret); ?>" size="50" />
                    </td>
                </tr>
                
            </tbody>
        </table>
        <input type="submit" name="save" id="btnsave" style="width: 150px; margin-right: 15px;"  value="Salvar" class="button-primary" />
         <input type="hidden" name="action" value="form-twitter" />
    </div>
</div>
</form>    