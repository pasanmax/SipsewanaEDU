<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    $conn = new Conn();
    $con = $conn->getConn();

    class Homework
    {
        private $hw_id;
        private $name;
        private $type;
        private $description;
        private $fileName;
        private $path = '../hw_creations/';
        private $hw_sub_id;

        function setHomework($name,$type,$description,$fileName,$hw_sub_id)
        {
            $this->name = $name;
            $this->type = $type;
            $this->description = $description;
            $this->fileName = $fileName;
            $this->hw_sub_id = $hw_sub_id;
        }

        public function getLastID()
        {
            try {
                global $con;
                $result = $con->query("SELECT hw_id FROM homework ORDER BY hw_id DESC LIMIT 1");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['hw_id'];
                    }
                    return $id;
                } else {
                    return null;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function getSubId($hw_id) {
            try {
                global $con;
                $result = $con->query("SELECT hw_sub_id FROM homework WHERE hw_id='".$hw_id."'");
                if ($result->num_rows == 1) {
                    while ($row = $result->fetch_assoc()) {
                        $hw_sub_id = $row['hw_sub_id'];
                    }
                    return $hw_sub_id;
                } elseif ($result === false) {
                    throw new Exception("Database Error!");
                } else {
                    return null;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function getFileName($hw_id) {
            try {
                global $con;
                $result = $con->query("SELECT fileName FROM homework WHERE hw_id='".$hw_id."'");
                if ($result->num_rows == 1) {
                    while ($row = $result->fetch_assoc()) {
                        $fileName = $row['fileName'];
                    }
                    return $fileName;
                } else {
                    return null;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function getPath($hw_id) {
            try {
                global $con;
                $result = $con->query("SELECT path FROM homework WHERE hw_id='".$hw_id."'");
                if ($result->num_rows == 1) {
                    while ($row = $result->fetch_assoc()) {
                        $path = $row['path'];
                    }
                    return $path;
                } else {
                    return null;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }
}
else
{
    header('location:../pages/Student/Login.php');
}
?>