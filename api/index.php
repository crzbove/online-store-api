<?

echo "<pre>";
echo "Server:";
var_dump($_SERVER);
echo "<br>Cookies:";
var_dump($_COOKIE);
echo "<br><br>Env:";
var_dump($_ENV);
echo "<br><br>---------------------------------<br>";
echo "/var/task/user/api";
echo "</pre>";

phpinfo();
