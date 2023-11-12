<?php

 $encryptKey = 'Xtv2puXc3ldvToiaSQzw6qoN6Y6LXBtM';
 $encryptIV = 'SQzw6qoN6Y6LXBtM';

$userId = '16';

//$encryptedValue = openssl_encrypt($userId, 'aes-256-cbc', $encryptionKey, 0, $encryptionKey);

//echo $encryptedValue;


// $originalValue = "16";
// $encryptedValue = base64_encode(encryptFunction($originalValue));
// setcookie("encrypted_cookie", $encryptedValue, time() + 3600, '/');



// Encrypt and encode


// Generate random key and IV



$encryptedValue = openssl_encrypt($userId, 'aes-256-cbc', $encryptKey, 0, $encryptIV);


$encodedEncryptedValue = base64_encode($encryptedValue);
setcookie("encrypted_cookie", $encodedEncryptedValue, time() + 3600, '/');

echo $encodedEncryptedValue

?>