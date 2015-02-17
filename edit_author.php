<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8 />
  <link type="text/css" rel="stylesheet" href="css/admin.css" />
  <title><?php require_once 'connect.php'; echo "Отредактировать автора";?>. Админка</title>
</head>
<body>
  <table id="wrapper">
    <tr><td id="header">
	<a href="/lib/"><img id="book" src="img/book.png"></a>
	<h1>Редактирование автора. Админка электронной библиотеки</h1></td>
	<tr><td>
    <ul id="menu">
      <li><a href="admin.php">показать авторов</a></li>
      <li><a href="add_author.php">добавить автора</a></li>
      <li><a href="show_books.php">показать произведения</a></li>
      <li><a href="add_book.php">добавить произведение</a></li>
    </ul>
  </td></tr>
  <tr><td>
    <form action="edit_author.php" method="POST">
      <fieldset>
        <legend>Отредактировать автора</legend>
<?php if (isset($_GET["id"])) {
  $result = mysqli_query($db, "SELECT * FROM authors WHERE author_id=".$_GET["id"].";");
  $myrow = mysqli_fetch_array($result);
} ?>
        <p>Внесите исправления и нажмите "Сохранить"</p>
        <p>Имя: <input type="text" name="firstname" size="30" value=
<?php if (isset($myrow)) echo '"'.$myrow["firstname"].'"'; else echo '""' ?> required /></p>
        <p>Фамилия: <input type="text" name="lastname" size="30" value=
<?php if (isset($myrow)) echo '"'.$myrow["lastname"].'"'; else echo '""' ?> required /></p>
        <input type="hidden" name="id" value=
<?php if (isset($myrow)) echo $myrow["author_id"]; else echo '""' ?> required />
        <p><input type="reset" name="reset" value="Сбросить">&nbsp;&nbsp;&nbsp;
        <input type="submit" name="submit" value="Сохранить"></p>
<?php if((isset ($_POST["id"])) and (isset($_POST["firstname"])) and (isset($_POST["lastname"])))
  {
    $update_query = 'UPDATE authors SET firstname="'.$_POST["firstname"].'", lastname="'.$_POST["lastname"].
    '" WHERE author_id="'.$_POST["id"].'";';
    mysqli_query($db, $update_query);
    echo "<p>Автор <b>".$_POST["firstname"]." ".$_POST["lastname"]."</b> был изменен</p>";
  }

?>
      </fieldset>
    </form>
  </td></tr>
	<tr><td id="footer"><p>&nbsp;&copy;&nbsp;Vladimir Zhirny, 2014</p></td>
  </table>
</body>