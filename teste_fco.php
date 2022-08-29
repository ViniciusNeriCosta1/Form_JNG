<!doctype html>
<html>
<head>
    <title>Windows Username</title>
</head>
<body>
<?php

echo getenv("REMOTE_ADDR");
echo "     ";
echo getenv("UserName");
echo "     ";
echo getenv("username");
echo "     ";
echo getenv("whoami");
echo "     ";
echo getenv("HTTP_CLIENT_IP");
echo "<pre>";
	var_dump($_SERVER);
	die();

echo get_current_user();



?>
</body>
</html>