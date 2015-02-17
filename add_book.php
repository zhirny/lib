<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8 />
  <link type="text/css" rel="stylesheet" href="css/admin.css" />
  <title><?php require_once 'connect.php'; echo "Добавить произведение"; ?>. Админка</title>
</head>
<body>
  <table id="wrapper">
    <tr><td id="header">
	<a href="/lib/"><img id="book" src="img/book.png"></a>
	<h1>Добавление произведения. Админка электронной библиотеки</h1></td>
	<tr><td>
    <ul id="menu">
      <li><a href="admin.php">показать авторов</a></li>
      <li><a href="add_author.php">добавить автора</a></li>
      <li><a href="show_books.php">показать произведения</a></li>
      <li><a href="add_book.php">добавить произведение</a></li>
    </ul>
  </td></tr>
  <tr><td>
    <form action="add_book.php" method="POST">
      <fieldset>
        <legend>Добавление произведения</legend>
        <p>Добавьте произведение, выберите автора и нажмите "Сохранить"</p>
        <p>Название произведения: <input type="text" name="title" size="150" required /></p>
        <p>Автор: <select name="author" required><option></option>
<?php $result = mysqli_query($db, "SELECT * FROM authors;");
      while ($myrow = mysqli_fetch_array($result)) {
        $author = $myrow["firstname"]." ".$myrow["lastname"];
        $author_id = $myrow["author_id"];
        echo '<option value="'.$author_id.'">'.$author.'</option>';
      }
?></select>
        <p>Год выпуска: <input type="number" name="year" size="4" required></p>
        <p><input type="reset" name="reset" value="Сбросить">&nbsp;&nbsp;&nbsp;
        <input type="submit" name="submit" value="Сохранить"></p>
<?php if (isset($_POST["author"]) and isset($_POST["title"]) and isset($_POST["year"])) {
          $insert_query = 'INSERT INTO books (title, author_id, year) 
          VALUES ("'.$_POST["title"].'", "'.$_POST["author"].'", "'.$_POST["year"].'");';
          mysqli_query($db, $insert_query);
          echo "<p>Произведение <b>".$_POST["title"]." </b> было добавлено</p>";
      }
?>
      </fieldset>
    </form>
  </td></tr>
	<tr><td id="footer"><p>&nbsp;&copy;&nbsp;Vladimir Zhirny, 2014</p></td>
  </table>
</body>