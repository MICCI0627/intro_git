<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
  print'ログインされていません。<br />';
  print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
}
else
{
  print$_SESSION['staff_name'];
  print'さんログイン中<br />';
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

<?php
// エラーを出力する
ini_set('display_errors', "On");

try
{

  $pro_code=$_POST['code'];
  $pro_name=$_POST['name'];
  $pro_price=$_POST['price'];
  $pro_gazou_name_old=$_POST['gazou_name_old'];
  $pro_gazou_name=$_POST['gazou_name'];

  $pro_code= htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
  $pro_name= htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
  $pro_price= htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

  $dsn ='mysql:dbname=cd_shop;host=localhost;charset=utf8';
  $user ='root';
  $password ='root';
  $dbh =new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql = 'update cd_product set name =:name, price=:price, gazou=:gazou where code = :code';
  $stmt = $dbh->prepare($sql);

// var_dump($pro_price);
// die;
//   変数をsql文にあてこむ
  $stmt->bindParam(':name', $pro_name, PDO::PARAM_STR);
  $stmt->bindParam(':price', $pro_price, PDO::PARAM_STR);
  $stmt->bindParam(':code', $pro_code, PDO::PARAM_STR);
  $stmt->bindParam(':gazou', $pro_gazou_name, PDO::PARAM_STR);


  // $sql ='INSERT INTO mst_product(name,price) VALUES (?,?)';
  // $stmt =$dbh->prepare($sql);
  // $data[] =$pro_name;
  // $data[] =$pro_price;
  // var_dump($data); 使い方
  // die;
  // $stmt->execute();
  //
  // $dbh =null;

  // $sql ='UPDATE mst_product SET name=?,price=? WHERE code=?';
  // $stmt =$dbh->prepare($sql);
  // $data[] =$pro_name;
  // $data[] =$pro_price;
  // $data[] =$pro_code;
  // var_dump($data); 使い方
  // die;
  $stmt->execute();

  $dbh =null;


if($pro_gazou_name_old!=$pro_gazou_name)
{
    if($pro_gazou_name_old!='')
    {
        unlink('./gazou/'.$pro_gazou_name_old);
    }
}

  print '修正しました。　<br />';

}
catch(Exception $e)
{
  var_dump($e); //エラー文でる記述
  print'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

?>

<a href="pro_list.php">戻る</a>

<body>

</body>
</html>
