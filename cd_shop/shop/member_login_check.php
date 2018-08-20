<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/style.css">
    <title>CDショップ</title>
</head>

<body>

<?php
// エラーを出力する
ini_set('display_errors', "On");

try
{
  require_once('../common/common.php');

  $post=sanitize($_POST);
  $member_email=$post['email'];
  $member_pass=$post['pass'];

  // $staff_code= htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
  // $staff_pass= htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

  $member_pass=md5($member_pass);

  $dsn ='mysql:dbname=cd_shop;host=localhost;charset=utf8';
  $user ='root';
  $password ='root';
  $dbh =new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql ='SELECT code,name FROM dat_member WHERE email=? AND password=?';
  $stmt =$dbh->prepare($sql);
  $data[]=$member_email;
  $data[]=$member_pass;
  $stmt->execute($data);

  $dbh =null;

  $rec =$stmt->fetch(PDO::FETCH_ASSOC);
if($rec==false)
{
  print'メールアドレスかパスワードが間違っています。<br />';
  print'<a href="member_login.html">戻る</a>';
}
else
{
  session_start();
  $_SESSION['member_login']=1;
  $_SESSION['member_code']=$rec['code'];
  $_SESSION['member_name']=$rec['name'];
  header('Location:shop_list.php');
  exit();
}

}
catch(Exception $e)
{
  // var_dump($e); //エラー文でる記述
  print'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

?>

</body>
</html>
