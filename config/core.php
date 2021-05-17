<?php
/*!
\file
\brief Заголовочный файл с описанием страниц

Данный файл содержит в себе определения основных 
классов, используемых в программе
*/

$page = isset($_GET['page']) ? $_GET['page'] : 1; 
  
// set number of records per page
$records_per_page = 5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>