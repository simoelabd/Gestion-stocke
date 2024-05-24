<?php

class user{

    public $id;
    public $username;
    public $email;
    public $password;
    public $reg_date; 


    public static $errorMsg = "";

    public static $successMsg="";


    public function __construct($username,$email,$password){

        //initialize the attributs of the class with the parameters, and hash the password
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password,PASSWORD_DEFAULT);

    }

    public function insertClient($tableName,$conn){

        //insert a client in the database, and give a message to $successMsg and $errorMsg
        $sql = "INSERT INTO $tableName (username, email, password)
        VALUES ('$this->username', '$this->email', '$this->password')";
        if (mysqli_query($conn, $sql)) {
        self::$successMsg= "New record created successfully";
        } else {
            self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}