<?php

class Connection{

    private $servername="localhost:3306";
    private $username="root";
    private $password="";
    public $conn;

    public function __construct(){
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password);
        // Check connection
        if (!$this->conn){
        die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function selectDatabase($dbName){
        //select database with the conn of the class, using mysqli_select..
        mysqli_select_db( $this->conn,$dbName);
    }
}
?>
