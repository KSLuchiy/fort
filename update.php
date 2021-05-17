<?php

/**
* @file
* \brief Редактирование объекта 
*/

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
	/// подключение заголовочных файлов
	include_once 'config/database.php';
	include_once 'objects/product.php';
	include_once 'objects/category.php';
  
	/// объект БД
	$database = new Database();
	$db = $database->getConnection();
  
	/// подготовка объектов
	$product = new Product($db);
	$category = new Category($db);
  
	/// установка значения по ключу для редактирования записи
	$product->id = $id;
  
 // чтение деталей об объекте
$product->readOne(); 

$page_title = "Изменение записи";
include_once "header.php";
  
echo "<div class='right-button-margin'>
          <a href='index.php' class='btn btn-default pull-right'>Назад</a>
     </div>";
  
?>
<?php 
/// если пользователь нажал на обновить форму
if($_POST){
  
    /// устанавливаем значения
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->description = $_POST['description'];
    $product->category_id = $_POST['category_id'];
  
    /// редактируем объект
    if($product->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Запись обновлена.";
        echo "</div>";
    }
  
    /// если не обновили - вывод сообщения
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Невозможно обновить запись.";
        echo "</div>";
    }
}
?>
  
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Наименование</td>
            <td><input type='text' name='name' value='<?php echo $product->name; ?>' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Цена</td>
            <td><input type='text' name='price' value='<?php echo $product->price; ?>' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Описание</td>
            <td><textarea name='description' class='form-control'><?php echo $product->description; ?></textarea></td>
        </tr>
  
        <tr>
            <td>Категория</td>
            <td>
              <?php
$stmt = $category->read();
  
/// список категории
echo "<select class='form-control' name='category_id'>";
  
    echo "<option>Выбор категории...</option>";
    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
        $category_id=$row_category['id'];
        $category_name = $row_category['name'];
  
        /// выбор категории
        if($product->category_id==$category_id){
            echo "<option value='$category_id' выбран>";
        }else{
            echo "<option value='$category_id'>";
        }
  
        echo "$category_name</option>";
    }
echo "</select>";
?>
            </td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </td>
        </tr>
  
    </table>
</form>
  <?
/// подключение файла подвала
include_once "footer.php";
?>