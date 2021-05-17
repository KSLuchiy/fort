<?php
/// @file 
/**
*@class для создания объекта БД
*/

class Database{
   
/*!
\file
\brief Заголовочный файл с описанием настроек доступа к БД

Данный файл содержит в себе определения основных 
классов, используемых в программе
*/
    private $host = "localhost";
    private $db_name = "php_db";
    private $username = "root";
    private $password = "";
    public $conn;
   
    ///@fn: функция подключения к БД
    public function getConnection(){
   
        $this->conn = null;
   
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
   
        return $this->conn;
    }
}
?>