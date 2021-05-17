<?php

/**
* @file
* \brief Создание объекта (добавление) в базу
*/

$page_title = "Добавление записи";
include_once "header.php";
 
// подключаем заголовочные файлы
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';
  
// получаем соединение с БД
$database = new Database();
$db = $database->getConnection();
  
// получаем доступ к объектам
$product = new Product($db);
$category = new Category($db);
 
echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Назад</a>
    </div>";
  
?>
<?php 
// Проверка действия
if($_POST){
  
    // устанавка значений свойств объекта
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->description = $_POST['description'];
    $product->category_id = $_POST['category_id'];
  
    // создание нового объекта
    if($product->create()){
        echo "<div class='alert alert-success'>Запись была добавлена.</div>";
    }
  
    
    else{
        echo "<div class='alert alert-danger'>Невозможно добавить объект.</div>";
    }
}
?>
  
<!-- HTML form  создания объекта-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
  
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Название</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Цена</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Описание</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
  
        <tr>
            <td>Категория</td>
            <td>
            <?php
			// чтение объекта из БД (используя функцию)
			$stmt = $category->read();
  
			
			echo "<select class='form-control' name='category_id'>";
			echo "<option>Выбор категории...</option>";
  
    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row_category);
        echo "<option value='{$id}'>{$name}</option>";
    }
  
echo "</select>";
?>
            </td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </td>
        </tr>
  
    </table>
</form>
<?php
  
// подвал
include_once "footer.php";
?>