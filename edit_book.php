<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8 />
  <link type="text/css" rel="stylesheet" href="css/admin.css" />
  <title><?php require_once 'connect.php'; echo "Отредактировать произведение";?>. Админка</title>
</head>
<body>
  <table id="wrapper">
    <tr><td id="header">
	<a href="/lib/"><img id="book" src="img/book.png"></a>
	<h1>Редактирование произведения. Админка электронной библиотеки</h1></td>
	<tr><td>
    <ul id="menu">
      <li><a href="admin.php">показать авторов</a></li>
      <li><a href="add_author.php">добавить автора</a></li>
      <li><a href="show_books.php">показать произведения</a></li>
      <li><a href="add_book.php">добавить произведение</a></li>
    </ul>
  </td></tr>
  <tr><td>
    <form action="edit_book.php" method="POST">
      <fieldset>
        <legend>Отредактировать произведение</legend>
<?php if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $result = mysqli_query($db, "SELECT * FROM books WHERE id=".$id.";");
        $myrow = mysqli_fetch_array($result);
      }
?>
        <p>Внесите исправления и нажмите "Сохранить"</p>
        <p>Название произведение: <input type="text" name="title" size="150" value=
<?php if (isset($myrow)) echo '"'.$myrow["title"].'"'; else echo '""' ?> required /></p>
        <p>Автор: 
        <select name="author" required>
<?php $old_author_id = $myrow["author_id"];
      $year = $myrow["year"];
      $result = mysqli_query($db, "SELECT * FROM authors;");
      while ($myrow = mysqli_fetch_array($result)) {
        $author_id = $myrow["author_id"];
        $author = $myrow["firstname"]." ".$myrow["lastname"];
        if ($old_author_id != $author_id) echo '<option value="'.$author_id.'">'.$author.'</option>';
        else echo '<option value="'.$author_id.'" selected>'.$author.'</option>';
      }
?></select>
        <p><input type="number" name="year" size="4" value="<?php echo $year; ?>" required /></p>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <p><input type="reset" name="reset" value="Сбросить">&nbsp;&nbsp;&nbsp;
        <input type="submit" name="submit" value="Сохранить"></p>
        
<?php if(isset($_POST["id"]))
  {
    $update_query = 'UPDATE books SET title="'.$_POST["title"].'", author_id="'.$_POST["author"].
    '", year="'.$_POST["year"].'" WHERE id="'.$_POST["id"].'";';
    mysqli_query($db, $update_query);
    echo "<p>Произведение <b>".$_POST["title"]." </b> было отредактировано</p>";
  }

?>
      </fieldset>
    </form>
  </td></tr>
	<tr><td id="footer"><p>&nbsp;&copy;&nbsp;Vladimir Zhirny, 2014</p></td>
  </table>
</body>