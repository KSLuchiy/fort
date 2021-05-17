<?php
// если кликнули по форме
if($_POST){
  
    // подключаем заголовочные файлы
    include_once 'config/database.php';
    include_once 'objects/product.php';
  
    // подключение к БД
    $database = new Database();
    $db = $database->getConnection();
  
    // создание объекта
    $product = new Product($db);
      
    // устанавливаем продукт, который планируется удалить
    $product->id = $_POST['object_id'];
      
    // удаление объекта
    if($product->delete()){
        echo "Объект удален.";
    }
      
    // 
    else{
        echo "Невозможно удалить объект.";
    }
}
?>