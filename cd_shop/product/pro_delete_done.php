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

<body>

<?php
// エラーを出力する
ini_set('display_errors', "On");
error_reporting(E_ALL);

try
{
  $pro_code=$_POST['code'];
  $pro_gazou_name=$_POST['gazou_name'];


  $dsn='mysql:dbname=cd_shop;host=localhost;charset=utf8';
  $user='root';
  $password ='root';
  $dbh =new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


  // $sql='UPDATE mst_staff SET name=?,password=? WHERE code=?';
  // $stmt =$dbh->prepare($sql);
  // $data[]=$staff_code;
  // $data[]=$staff_name;
  // $data[]=$staff_pass;


  $sql = 'DELETE from cd_product where code = :code';
  $stmt = $dbh->prepare($sql);

  // 変数をsql文にあてこむ

  $stmt->bindParam(':code', $pro_code, PDO::PARAM_STR);

  // update処理実行
  $stmt->execute();


  // var_dump($data);
  // die;
  // $stmt->execute($data);

  $dbh=null;
  // var_dump($dbh); //エラー文でる記述
  // die;

if($pro_gazou_name!='')
{
  unlink('./gazou/'.$pro_gazou_name);
}

}
catch(Exception $e)
{
  var_dump($e);
  print'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

?>

削除しました。 <br />
<br />
<a href="pro_list.php">戻る</a>

</body>
</html>
