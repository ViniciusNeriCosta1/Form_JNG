<!doctype html>
<html>
<head>
    <title>Windows Username</title>
</head>
<script type="text/javascript">
    var WinNetwork = new ActiveXObject("WScript.Network");
	windows.print(WinNetwork.UserName); 
 
</script>
<body>
<?php

echo getenv("REMOTE_ADDR");
echo "     ";
echo getenv("UserName");
echo "     ";
echo getenv("username");
echo "     ";
echo getenv("whoami");

echo get_current_user();



?>
</body>
</html>