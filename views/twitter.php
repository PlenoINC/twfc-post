<?php
/**
 * Este arquivo é parte do plugin TWFC-Post.
 * (c) Reinaldo Rodrigues <contato@reinaldorodrigues.com.br>  * 
 * 
 */
?>
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
    </div>
</div>