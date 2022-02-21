<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/SipsewanaEDU/config.php";

$conn = new Conn();
$con = $conn->getConn();
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

$cashier = new Cashier();

if(isset($_POST['signin']))
{
    $cashier->login($_POST['username'],$_POST['password']);
}
else if(isset($_GET['logout']))
{
    $cashier->logout();
}
else if(isset($_POST['registerCashier']))
{
    if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['cno']) || empty($_POST['dob']) || empty($_POST['email'])
    || empty($_POST['adrsl1']) || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district']) || empty($_POST['zipcode'])) {
        header('location:../pages/Front Officer/Cashiers/Manage/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $cashier->setCashier($_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],
        $_POST['city'],$_POST['district'],$_POST['zipcode'],$_POST['email'],$_POST['cno']);
        $cashier->register();
    }
}
if (isset($_POST['caspaySearch'])) {
    if (empty($_POST['cashierid'])) {
        header('location:../pages/Front Officer/Cashiers/PaidPayment/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Invalid cashier ID!";
    } else {
        $cashier->setCashierId($_POST['cashierid']);
        $cashier->setCasPaySession();
    }
}


class Cashier
{
    // properties
    protected $cashier_id;
    protected $fname;
    protected $lname;
    protected $usrname;
    protected $passwordHash;
    protected $dob;
    protected $adrsl1;
    protected $adrsl2;
    protected $adrsl3;
    protected $city;
    protected $district;
    protected $zipcode;
    protected $email;
    protected $contactNo;

    // methods
    function setCashier($fname,$lname,$dob,$adrsl1,$adrsl2,$adrsl3,$city,$district,$zipcode,$email,$contactNo)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = date("Y-m-d", strtotime($dob));
        $this->adrsl1 = $adrsl1;
        $this->adrsl2 = $adrsl2;
        $this->adrsl3 = $adrsl3;
        $this->city = $city;
        $this->district = $district;
        $this->zipcode = $zipcode;
        $this->email = $email;
        $this->contactNo = $contactNo;
    }

    function setCashierId($cashier_id)
    {
        $this->cashier_id = $cashier_id;
    }

    function setCasPaySession()
        {
            header('location:../pages/Front Officer/Cashiers/PaidPayment/List.php');
            $_SESSION['caspayid']=$this->cashier_id;
        }

    function register()
    {
        try {
            global $con;
            $fname = $this->fname;
            $lname = $this->lname;
            $dob = $this->dob;
            $adrsl1 = $this->adrsl1;
            $adrsl2 = $this->adrsl2;
            $adrsl3 = $this->adrsl3;
            $city = $this->city;
            $district = $this->district;
            $zipcode = $this->zipcode;
            $email = $this->email;
            $contactNo = $this->contactNo;
            
            if($con->query("INSERT INTO cashier (fname,lname,dob,adrsl1,adrsl2,adrsl3,city,district,zipcode,email,contactno) VALUES ('$fname','$lname','$dob','$adrsl1','$adrsl2','".$adrsl3."','$city','$district','$zipcode','$email','$contactNo')") === TRUE) {
                header('location:../pages/Front Officer/Cashiers/Register/Register.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Entered Successfully!";
            } else {
                header('location:../pages/Front Officer/Cashiers/Register/Register.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
                // echo "Error: ".$con->error;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function getName($cashier_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT fname,lname FROM cashier WHERE cashier_id='".$cashier_id."'");
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

    public function getEmail($cashier_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT c.email FROM cashier c WHERE c.cashier_id='".$cashier_id."'");
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
            $result = $con->query("SELECT usrname,cashier_id,passwordhash FROM cashier WHERE usrname='".$username."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    if($row['usrname']==$username && password_verify($password, $row['passwordhash'])) {
                        $_SESSION['id']=$row['cashier_id'];
                        header('location:../pages/Cashier/Dashboard.php');
                        //setcookie("id", $row['student_id']);
                    } else {
                        header('location:../pages/Cashier/Login.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Username and Password don't match!";
                    }
                }
            } else {
                header('location:../pages/Cashier/Login.php');
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
                header('location:../pages/Cashier/Login.php');
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

}


?>