<?php
class Conn
{
    function getConn()
    {
        $conn = new mysqli("localhost","root","","sipsewanaedu");
        if($conn->connect_error)
        {
            header("Location: 500Error.php");
            die("Error in connection".$conn->connect_error);
        }
        return $conn;
    }
}
?>