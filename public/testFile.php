<?php

// unique_order_id|total_amount
$plaintext = '525|10';
$publickey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDNCPEkmw52ZWPv+J5N1rwkr6Ky
wi3Q07qHvffTvdkrEHNvAY7EmEB7xyjBkONF58CfJP7TPSd7yR1pbpr9cLELbJzR
kb61y2tkVIV+SXvxdwpD5gNEMmtndeKz/rIU6XvRp1nnICbK/5tLNY4sdVTZTbfK
sUt1suOUmQn13v3bVQIDAQAB
-----END PUBLIC KEY-----";
//load public key for encrypting
openssl_public_encrypt($plaintext, $encrypt, $publickey);

//encode for data passing
$payment = base64_encode($encrypt);
//checkout URL
$url = 'https://webxpay.com/index.php?route=checkout/billing';

//custom fields
//cus_1|cus_2|cus_3|cus_4
$custom_fields = base64_encode('cus_1|cus_2|cus_3|cus_4');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Webxpay">
    <title>WebXPay | Sample checkout form</title>
  </head>
  <body>     	  
       <form action="<?php echo $url; ?>" method="POST">
			First name: <input type="text" name="first_name" value="Customer First Name"><br>
			Last name: <input type="text" name="last_name" value="Customer Last Name"><br>
			Email: <input type="text" name="email" value="customer_email@email.com"><br>
			Contact Number: <input type="text" name="contact_number" value="0773606370"><br>
			Address Line 1: <input type="text" name="address_line_one" value="46/46, Green Lanka Building"><br>
			Address Line 2: <input type="text" name="address_line_two" value="Nawam Mawatha"><br>
			City: <input type="text" name="city" value="Colombo"><br>
			State: <input type="text" name="state" value="Western"><br>
			Zip/Postal Code: <input type="text" name="postal_code" value="10300"><br>
			Country: <input type="text" name="country" value="Sri Lanka"><br>
			currency: <input type="text" name="process_currency" value="LKR"><br> <!-- currency value must be LKR or USD -->
			CMS : <input type="text" name="cms" value="PHP">
			custom: <input type="text" name="custom_fields" value="<?php echo $custom_fields; ?>">
			Mechanism: <input type="text" name="enc_method" value="JCs3J+6oSz4V0LgE0zi/Bg==">
			<br/>		   
			<!-- POST parameters -->
			<input type="hidden" name="secret_key" value="5460b737-77ea-425a-801a-75438d0dddcb" >  
			<input type="hidden" name="payment" value="<?php echo $payment; ?>" >                         
			<input type="submit" value="Pay Now" >
        </form>      
  </body>
</html>
