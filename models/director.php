<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/SipsewanaEDU/config.php";

$conn = new Conn();
$con = $conn->getConn();
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

$director = new Director();

if(isset($_POST['signin']))
{
    $director->login($_POST['username'],$_POST['password']);
}
else if(isset($_GET['logout']))
{
    $director->logout();
}
else if(isset($_POST['registerDirector']))
{
    if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['cno']) || empty($_POST['dob']) || empty($_POST['email'])) {
        header('location:../pages/Front Officer/Directors/Manage/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $director->setDirector($_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['email'],$_POST['cno']);
        $director->register();
    }
}


class Director
{
    // properties
    protected $fname;
    protected $lname;
    protected $usrname;
    protected $passwordHash;
    protected $dob;
    protected $email;
    protected $contactNo;

    // methods
    function setDirector($fname,$lname,$dob,$email,$contactNo)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = date("Y-m-d", strtotime($dob));
        $this->email = $email;
        $this->contactNo = $contactNo;
    }

    public function getName($director_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT fname,lname FROM director WHERE dir_id='".$director_id."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $director_name = $row['fname']." ".$row['lname'];
                }
                return $director_name;
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

    public function getEmail($director_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT d.email FROM director d WHERE d.dir_id='".$director_id."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $email = $row['email'];
                }
                return $email;
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

    public function login($username,$password)
    {
        try {
            global $con;
            $result = $con->query("SELECT usrname,dir_id,passwordhash FROM director WHERE usrname='".$username."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    if($row['usrname']==$username && password_verify($password, $row['passwordhash'])) {
                        $_SESSION['id']=$row['dir_id'];
                        header('location:../pages/Director/Dashboard.php');
                        //setcookie("id", $row['student_id']);
                    } else {
                        header('location:../pages/Director/Login.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Username and Password don't match!";
                    }
                }
            } else {
                header('location:../pages/Director/Login.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Please enter Username & Password";
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function logout()
    {
        try{
            global $con;
            if (isset($_SESSION['id'])) {
                session_destroy();
                header('location:../pages/Director/Login.php');
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function register()
    {
        try {
            global $con;
            $fname = $this->fname;
            $lname = $this->lname;
            $dob = $this->dob;
            $email = $this->email;
            $contactNo = $this->contactNo;
            
            if($con->query("INSERT INTO director (fname,lname,dob,email,contactno) VALUES ('$fname','$lname','$dob','$email','$contactNo')") === TRUE) {
                header('location:../pages/Front Officer/Directors/Register/Register.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Entered Successfully!";
            } else {
                header('location:../pages/Front Officer/Directors/Register/Register.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
                // echo "Error: ".$con->error;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

}


?>