<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
  setcookie();
}
session_destroy(session_name(),'',time()-42000,'/');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/style.css">
    <title>CDショップ</title>
</head>

<body>
ログアウトしました。<br />
<br />
<a href="../staff_login/staff_login.html">ログイン画面へ</a>

</body>
</html>
