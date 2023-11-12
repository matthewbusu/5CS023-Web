<?php

 $encryptKey = 'Xtv2puXc3ldvToiaSQzw6qoN6Y6LXBtM';
 $encryptIV = 'SQzw6qoN6Y6LXBtM';
// $encryptedCookie = '1Wpg2H4cZFYSJ32BgZx%2FvA%3D%3D';
// $userId = openssl_decrypt($encryptedCookie, 'aes-256-cbc', $encryptionKey, 0, $encryptionKey);

// echo $userId;






// Retrieve and decode
// $encryptedCookie = $_COOKIE['encrypted_cookie'];
// $decryptedValue = decryptFunction(base64_decode($encryptedCookie));
// echo $decryptedValue;



// Retrieve the URL encoded encrypted value from the cookie
$encodedEncryptedCookie = $_COOKIE['encrypted_cookie'];

// Decode the value before decrypting
$decodedEncryptedValue = base64_decode($encodedEncryptedCookie);

// Decrypt the value when needed
$decryptedValue = openssl_decrypt($decodedEncryptedValue, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

// Output the decrypted value
echo $decryptedValue;

?>


