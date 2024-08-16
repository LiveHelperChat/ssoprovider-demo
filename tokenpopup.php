<?php
require 'vendor/autoload.php';
require 'provider.php';
session_start();

$existingAccessToken = new \League\OAuth2\Client\Token\AccessToken(json_decode(file_get_contents('token.json'),true));

if ($existingAccessToken->hasExpired()) {
    try {
        $newAccessToken = $provider->getAccessToken('refresh_token', [
            'refresh_token' => $existingAccessToken->getRefreshToken()
        ]);
        $existingAccessToken = $newAccessToken;
        file_put_contents('token.json',json_encode($newAccessToken->jsonSerialize()));
    } catch (Exception $e) {
        print_r($e); // Refresh failed. Redirect to login page again.
    }
}

// Get main details of the access token owner
// We just need $userInfo['id'] from this call. If you store this id internally on first login you can remove this call and use your own data.
try {
    $resourceOwner = $provider->getResourceOwner($existingAccessToken);
    $userInfo = $resourceOwner->toArray();
} catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    print_r($e->getResponseBody());
    // You can just try to redirect to login again.
} catch (Exception $e) {
    print_r($e->getMessage());
}

// Now let's call api to generate auto login link
$data = array(
    'u' => $userInfo['id'],
    'r' => AUTO_LOGIN_URL,
    't' => 10, // How long link is valid
);

$options['body'] = json_encode($data);
$options['headers']['Content-Type'] = 'application/json';
$options['headers']['Accept'] = 'application/json';

$request = $provider->getAuthenticatedRequest(
    'POST',
    LHC_API_CALL_URL,
    $existingAccessToken,
    $options
);

// curl -X POST "https://demo.livehelperchat.com/restapi/generateautologin" -H "accept: application/json" -H "authorization: Bearer <your_access_token>" -H "Content-Type: application/json" -d "{ \"u\": 1, \"r\": \"front/default\", \"t\": 10}"

try {
    $httpResponse = $provider->getParsedResponse($request);
    header('Location: '. $httpResponse['result']);
} catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    print_r($e->getResponseBody());
    // You can just try to redirect to login again.
} catch (Exception $e){
    print_r( $e);
}

?>



