<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>vpos-php demo</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

        <p>Payment request used to generate form:</p>
        <textarea rows="10" cols="60" readonly><?=$this->e($payment_request)?></textarea>

        <p>In a production environment, the following fields should be hidden:</p>
        <form method="post" action="https://test2.alignetsac.com/VPOS/MM/transactionStart20.do">
            <label for="IDCQUIRER">IDACQUIRER:</label>
            <input type="text" id="IDACQUIRER" name="IDACQUIRER" value="<?=$this->e($acquirer_id)?>"/><br/>
            <label for="IDCOMMERCE">IDCOMMERCE:</label>
            <input type="text" id="IDCOMMERCE" name="IDCOMMERCE" value="<?=$this->e($commerce_id)?>"/><br/>
            <label for="XMLREQ">XMLREQ:</label>
            <input type="text" id="XMLREQ" name="XMLREQ" value="<?=$this->e($ciphered_xml)?>"/><br/>
            <label for="DIGITALSIGN">DIGITALSIGN:</label>
            <input type="text" id="DIGITALSIGN" name="DIGITALSIGN" value="<?=$this->e($ciphered_signature)?>"/><br/>
            <label for="SESSIONKEY">SESSIONKEY:</label>
            <input type="text" id="SESSIONKEY" name="SESSIONKEY" value="<?=$this->e($ciphered_session_key)?>"/><br/>
            <input type="submit" value="Pay"/>
        </form>
    </body>
</html>
