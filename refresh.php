<?php
require 'vendor/autoload.php';
require 'provider.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Refresh token scenario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php

$existingAccessToken = new \League\OAuth2\Client\Token\AccessToken(json_decode(file_get_contents('token.json'),true));

// Always refresh token
//if ($existingAccessToken->hasExpired()) {
try {
    $newAccessToken = $provider->getAccessToken('refresh_token', [
        'refresh_token' => $existingAccessToken->getRefreshToken()
    ]);
    $existingAccessToken = $newAccessToken;
    file_put_contents('token.json',json_encode($newAccessToken->jsonSerialize()));
} catch (Exception $e) {
    print_r($e);
}

echo "Refresh happened";
?>
</body>
</html>



