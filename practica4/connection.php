<?php
class DatabaseConnection {
    var $servername = "127.0.0.1";
    var $username = "root";
    var $password = "";
    var $dbname = "example2";
    var $port = 3308;
    var $conn;
    function getConnstring() {
        $con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port) or die("Connection failed: " . mysqli_connect_error());
 
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            $this->conn = $con;
        }
        return $this->conn;
    }
}
?>
