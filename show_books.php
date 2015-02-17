<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8 />
  <link type="text/css" rel="stylesheet" href="css/admin.css" />
  <title><?php require_once 'connect.php';  echo "Список книг" ?>. Админка</title>

</head>
<body>
  <table id="wrapper">
    <tr><td id="header">
	<a href="/lib/"><img id="book" src="img/book.png"></a>
	<h1>Админка электронной библиотеки</h1></td>
	<tr><td>
    <ul id="menu">
      <li><a href="admin.php">показать авторов</a></li>
      <li><a href="add_author.php">добавить автора</a></li>
      <li><a href="show_books.php">показать произведения</a></li>
      <li><a href="add_book.php">добавить произведение</a></li>
    </ul>
  </td></tr>
  <tr><td>
    <form action="show_books.php" method="POST">
      <p>Фильтрация по автору: <select name="author" required><option></option>
<?php $result = mysqli_query($db, "SELECT * FROM authors;");
      while ($myrow = mysqli_fetch_array($result)) {
        $author = $myrow["firstname"]." ".$myrow["lastname"];
        $author_id = $myrow["author_id"];
        echo '<option value="'.$author_id.'">'.$author.'</option>';
      }
?></select>
    <input type="submit" value="Отфильтровать" /></p>
    </form>
    <table id="authors">
<?php 
  if (isset($_GET["id"])) {
    mysqli_query($db,"DELETE FROM books WHERE id=".$_GET['id'].";");
  }
  if (isset($_POST["author"])) $result = mysqli_query($db, "SELECT b.id, b.title, concat(a.firstname, ' ', a.lastname) as authorsName, b.year
  FROM authors a INNER JOIN books b ON a.author_id = b.author_id WHERE b.author_id = ". $_POST["author"]."
  ORDER BY title;");
 	else $result = mysqli_query($db, "SELECT b.id, b.title, concat(a.firstname, ' ', a.lastname) as authorsName, b.year
  FROM authors a INNER JOIN books b ON a.author_id = b.author_id
  ORDER BY title;");
  while ($myrow = mysqli_fetch_array($result)) {
    echo "<tr><td>"
	  .$myrow["id"]."</td><td>"
	  .$myrow["title"]."</td><td>"
	  .$myrow["authorsName"]."</td><td>"
    .$myrow["year"]."</td><td>"
    ."<a href='edit_book.php?id=".$myrow["id"]."'>редактировать</a>"."</td><td>"
    ."<a href='show_books.php?id=".$myrow["id"]."'>удалить</a>"."</td></tr>";
  } 
?>
    </table>    
  </td></tr>
	<tr><td id="footer"><p>&nbsp;&copy;&nbsp;Vladimir Zhirny, 2014</p></td>
  </table>
</body>