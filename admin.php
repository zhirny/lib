<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8 />
  <link type="text/css" rel="stylesheet" href="css/admin.css" />
  <title><?php require_once 'connect.php'; echo "Главная страница"; ?>. Админка</title>
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
    <table id="authors">
<?php 
  if (isset($_GET["id"])) {
    mysqli_query($db,"DELETE FROM books WHERE author_id=".$_GET['id'].";");
    mysqli_query($db,"DELETE FROM authors WHERE author_id=".$_GET['id'].";");
  }

 	$result = mysqli_query($db, "SELECT a.author_id, 
  concat(a.firstname, ' ', a.lastname) as authorsName, 
  count(b.id) as numberOfBooks
  FROM authors a LEFT JOIN books b ON a.author_id = b.author_id GROUP BY a.author_id
  ORDER BY authorsName;");
  while ($myrow = mysqli_fetch_array($result)) {
    echo "<tr><td>"
	  .$myrow["author_id"]."</td><td>"
	  .$myrow["authorsName"]."</td><td>"
    .$myrow["numberOfBooks"]."</td><td>"
    ."<a href='edit_author.php?id=".$myrow["author_id"]."'>редактировать</a>"."</td><td>"
    ."<a href='admin.php?id=".$myrow["author_id"]."'>удалить</a>"."</td></tr>";
  } 
?>
    </table>    
  </td></tr>
	<tr><td id="footer"><p>&nbsp;&copy;&nbsp;Vladimir Zhirny, 2014</p></td>
  </table>
</body>