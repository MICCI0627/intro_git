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

try
{
  $staff_code=$_POST['code'];

  $dsn ='mysql:dbname=cd_shop;host=localhost;charset=utf8';
  $user ='root';
  $password ='root';
  $dbh =new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql ='DELETE FROM cd_staff WHERE code=?';
  $stmt =$dbh->prepare($sql);

  $data[] =$staff_code;
  // var_dump($data); 使い方
  // die;
  $stmt->execute($data);

  $dbh =null;

}
catch(Exception $e)
{
  // var_dump($e); //エラー文でる記述
  print'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

?>
削除しました。 <br />
<br />
<a href="staff_list.php">戻る</a>

</body>
</html>
