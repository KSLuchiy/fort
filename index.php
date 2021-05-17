<?php
/**
* @file
* \brief  Главная страница
*/
/*!
	
	\author Семен Кузьмичев
	\version 1.0
	\date Май 2021 года
	\warning Данный проект создан в учебных целях
	
*/

$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// количество значений на странице
$records_per_page = 10;
  

$from_record_num = ($records_per_page * $page) - $records_per_page;
  
// core.php holds pagination variables
include_once 'config/core.php';  
  
// подключение заголовочных файлов
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';
  
/**
*инициализация объекта базы данных
*/
$database = new Database();
$db = $database->getConnection();
  
/**
*инициализация объектов сущности товара и категории
*/  
$product = new Product($db);
$category = new Category($db);
  
// запрос
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();



// 
$page_title = "Общая информация ";
include_once "header.php";
  

 
// the page where this paging is used
$page_url = "index.php?";
  
// подсчет всех записей в базе
$total_rows = $product->countAll();
  
// read_template.php controls how the product list will be rendered
include_once "read_template.php";  
// подвал
include_once "footer.php";
?>


