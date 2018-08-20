<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
  print'ようこそゲスト様 ';
  print'<a href="member_login.html">会員ログイン</a><br />';
  print'<br />';
}
else
{
  print'ようこそ';
  print$_SESSION['member_name'];
  print'様';
  print'<a href="member_logout.php">ログアウト</a><br />';
  print'<br />';
}
?>

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

  $dsn='mysql:dbname=cd_shop;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='SELECT code,name,price FROM cd_product WHERE 1';
  $stmt=$dbh->prepare($sql);
  // var_dump($data); 使い方
  // die;
  $stmt->execute();

  $dbh=null;

print '商品一覧<br /><br />';

while(true)
{
  $rec =$stmt->fetch(PDO::FETCH_ASSOC);
  if($rec==false)
  {
    break;
  }
  print'<a href="shop_product.php?procode='.$rec['code'].'">';
  print $rec['name'].'---';
  print $rec['price'].'円';
  print'</a>';
  print'<br />';
}

print'<br />';
print'<a href="shop_cartlook.php">カートを見る</a><br />';

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
