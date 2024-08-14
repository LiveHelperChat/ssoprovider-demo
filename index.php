<?php
require 'vendor/autoload.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SSO Integration sample</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php if (!is_writable('token.json')) : ?>
    I can't write to token.json file!
<?php else : ?>
    <ul>
        <li><a href="login.php">Login</a> </li>
        <li><a href="token.php">Token info after login. Click if you have already got token.</a></li>
        <li><a href="refresh.php">Force refresh token.</a></li>
    </ul>
<?php endif;?>

</body>
</html>



