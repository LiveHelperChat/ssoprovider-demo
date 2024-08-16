<?php

define("LHC_API_CALL_URL",'https://demo.livehelperchat.com/restapi/generateautologin');
define("AUTO_LOGIN_URL", "mailconv/sendemail/(layout)/popup");
define("POPUP_MODE", false);

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => '<client_id>',                     // The client ID assigned to you by the provider
    'clientSecret'            => '<client_secret>',                 // The client password assigned to you by the provider
    'redirectUri'             => 'https://example.com/sso/callback.php',  // Redirect URL, has to match SSOProvider extension redirect_url
    'urlAuthorize'            => 'https://demo.livehelperchat.com/site_admin/ssoprovider/authorize',
    'urlAccessToken'          => 'https://demo.livehelperchat.com/site_admin/ssoprovider/token',
    'urlResourceOwnerDetails' => 'https://demo.livehelperchat.com/site_admin/ssoprovider/userinfo'
]);

?>