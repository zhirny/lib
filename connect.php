<?php
  //задаем кодировку для корректного отображения сообщений об ошибках
  header('Content-Type: text/html; charset=utf-8');
  //подключаемся к серверу БД (@ перед mysqli-connect стоит для того, чтоб не выводился Warning)
  $db = @mysqli_connect('localhost', 'root', '') or die('Не удается соединиться с сервером БД.');
  //подключаемся к БД lib
  mysqli_select_db($db, 'lib') or die('Не удается подключиться к базе.');
  //задаем кодировку для корректного отображения извлеченного из БД
  mysqli_query($db, 'SET NAMES utf8');
