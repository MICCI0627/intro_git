<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
  print'ようこそゲスト様　';
  print'<a href="member_login.html">会員ログイン</a><br />';
  print'<br />';
}
else
{
  print'ようこそ';
  print$_SESSION['member_name'];
  print'様　';
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

  $pro_code=$_GET['procode'];

if(isset($_SESSION['cart'])==true)
{
  $cart=$_SESSION['cart'];
  $kazu=$_SESSION['kazu'];
  if(in_array($pro_code,$cart)==true)
  {
    print'その商品はすでにカートに入っています。<br />';
    print'<a href="shop_list.php">商品一覧に戻る</a>';
    exit();
  }
}
  $cart[]=$pro_code;
  $kazu[]=1;
  $_SESSION['cart']=$cart;
  $_SESSION['kazu']=$kazu;

// foreach ($cart as $key => $val)
//   {
//      print$val;
//      print'<br />';
//   }

// $max=count($cart);
// var_dump($cart);
// exit();


}
catch(Exception $e)
{
  // var_dump($e); //エラー文でる記述
  print'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

?>

カートに追加しました。　<br />
<br />
<a href="shop_list.php">商品一覧に戻る</a>

</body>
</html>
