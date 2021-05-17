<?php
/// @file 
/**
*@class для создания сущности объекта
*/
class Category{
  
     /// база данных и имя таблицы
    private $conn;
    private $table_name = "categories";
  
    ///@brief: свойства объекта
    public $id;
    public $name;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
	///@fn: функция получения имени сущности
	function readName(){
      
    $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
    $this->name = $row['name'];
}
  
    ///@fn: функция чтение из БД сущности
    function read(){
        //select all data
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
		///@return возврат значения
        return $stmt;
    }
  
}
?>