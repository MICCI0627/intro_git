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
  $staff_name=$_POST['name'];
  $staff_pass=$_POST['pass'];

  $staff_name= htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
  $staff_pass= htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

  $dsn ='mysql:dbname=cd_shop;host=localhost;charset=utf8';
  $user ='root';
  $password ='root';
  $dbh =new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql ='UPDATE cd_staff SET name=?,password=? WHERE code=?';
  $stmt =$dbh->prepare($sql);
  $data[] =$staff_name;
  $data[] =$staff_pass;
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
修正しました。 <br />
<br />
<a href="staff_list.php">戻る</a>

</body>
</html>
