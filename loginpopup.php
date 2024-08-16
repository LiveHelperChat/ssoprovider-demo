<?php

require 'vendor/autoload.php';
require 'provider.php';
session_start();

// Fetch the authorization URL from the provider; this returns the
// urlAuthorize option and generates and applies any necessary parameters
// (e.g. state).
$authorizationUrl = $provider->getAuthorizationUrl();

// Get the state generated for you and store it to the session.
$_SESSION['oauth2state'] = $provider->getState();

// Optional, only required when PKCE is enabled.
// Get the PKCE code generated for you and store it to the session.
$_SESSION['oauth2pkceCode'] = $provider->getPkceCode();

// Redirect the user to the authorization URL.
header('Location: ' . $authorizationUrl);
exit;




