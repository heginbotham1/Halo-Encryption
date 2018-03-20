<?php

$textToEncrypt = "Test";

$encryptionMethod = "AES-256-CBC";  //Used by various companies to protect their users data

$secretHash = "random+hash"; //Change this

$iv = "16testiv++++++++"; //Change this to a 16byte random characters



//To encrypt

$encryptedMessage = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash, 0, $iv);



//To Decrypt

$decryptedMessage = openssl_decrypt($encryptedMessage, $encryptionMethod, $secretHash, 0, $iv);







/**

 * In this case, we want to increase the default cost for BCRYPT to 12.

 * Note that we also switched to BCRYPT, which will always be 60 characters.

 */

$options = [

    'cost' => 12,

];

ob_start();

echo password_hash( $encryptedMessage, PASSWORD_BCRYPT, $options);

$storedPassword = ob_get_contents();

ob_end_clean();

echo $storedPassword;

echo "<br>Encrypted: $encryptedMessage<br> Decrypted: $decryptedMessage";



if (password_verify( $encryptedMessage, $storedPassword)) {

    echo '<br>Password is valid!';

} else {

    echo '<br>Invalid password.';

}
