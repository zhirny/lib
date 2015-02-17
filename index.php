<?php
/*изменение для гита*/
require_once 'connect.php';  
   
  function get_author_id() {
    $author_id = isset($_GET['id']) ? $_GET['id'] : null;
    return $author_id;
   }

	function get_title($author_id) {
    global $db;
    if($author_id){
      $result = mysqli_query($db, 'SELECT firstname, lastname FROM authors WHERE author_id=' . $author_id);
      $myrow  = mysqli_fetch_array($result);
      $title  = $myrow['firstname']. ' ' . $myrow['lastname']. '. Произведения';
    } else {
      $title = 'Главная страница';    
    }
    $title .= '. Веб интерфейс';
    return $title;
  }
   
  function get_books($author_id) {
    global $db;
    if(!$author_id){
      return '';
    }
    $result = mysqli_query($db, 'SELECT * FROM books WHERE author_id='.$author_id.' ORDER BY title;');
    $table = '<table id="bookstable">';
    while($myrow = mysqli_fetch_array($result)) {
      $table .= '<tr><td id="num">'.$myrow['id'].'</td><td>'.$myrow['title'].'</td><td id="year">'.$myrow['year'].'</td></tr>';
    }
    $table .= '</table>';
    return $table;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8 />
  <link type="text/css" rel="stylesheet" href="css/style.css" />
  <title><?php echo get_title(get_author_id()); ?></title>
</head>
<body>
  <table id="wrapper">
    <tr><td colspan=2 id="header">
	<a href="/lib/"><img id="book" src="img/book.png"></a>
	<h1>Электронная библиотека</h1></td>
	<tr><td id="authors">
	  <ul>
	    <li class="caption">Авторы</li>
<?php
	$result = mysqli_query($db, 'SELECT * FROM authors ORDER BY lastname;');
  while ($myrow = mysqli_fetch_array($result)) {
    echo '<li><a href="/lib/index.php?id='
	  .$myrow['author_id'].'">'
	  .$myrow['firstname'].' '.$myrow['lastname'].'</a></li>';
  } 
?>
	  </ul>
	</td>
	<td id="books">
	<ul>
	  <li class="caption">Произведения</li>
<?php
echo get_books(get_author_id());
?>
	<ul>
	</td></tr>
	<tr><td colspan=2 id="footer"><p>&nbsp;&copy;&nbsp;Vladimir Zhirny, 2014</p></td>
  </table>
</body>