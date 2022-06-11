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
if (isset($_GET['paymentID'])) {
    $list = $cashier->getPayment($_GET['paymentID']);
    if ($list == null) {
        header('location:../pages/Front Officer/Cashiers/ViewPayments/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="No records found!";
    } else {
        $cashier->generateReceipt($list);
    }
}
else if(isset($_POST['updatePayment']))
{
    if(empty($_POST['paymentid']) || empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['amount']) || empty($_POST['date'])) {
        header('location:../pages/Cashier/ViewPayments/PendingPayments/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $cashier->updatePayment($_POST['paymentid'],$_POST['date']);
    }
}
if(isset($_GET['delPay']))
{
    $cashier->deletePayment($_GET['delPay']);
}

class Cashier
{
    // properties
    private $cashier_id;
    private $fname;
    private $lname;
    private $usrname;
    private $passwordHash;
    private $dob;
    private $adrsl1;
    private $adrsl2;
    private $adrsl3;
    private $city;
    private $district;
    private $zipcode;
    private $email;
    private $contactNo;

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

    function getPayments($cashier_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT p.pay_id,s.subjectname,p.type,p.amount,p.date FROM cashier ca, payment p, subject s WHERE p.pay_cas_id=ca.cashier_id AND p.pay_sub_id=s.subject_id AND p.status='Paid' AND p.pay_cas_id='".$cashier_id."'");
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    return $data;
                } else {
                    return null;
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getPayment($payment_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT p.pay_id,CONCAT(st.fname, ' ' ,st.lname) AS 'name',s.subjectname,p.type,p.amount,p.date FROM cashier ca, payment p, student st, subject s WHERE p.pay_cas_id=ca.cashier_id AND p.pay_sub_id=s.subject_id AND p.pay_st_id=IF(p.pay_st_id!=NULL,st.student_id,st.student_id) AND p.status='Paid' AND p.pay_id='".$payment_id."' UNION SELECT p.pay_id,CONCAT(l.fname, ' ' ,l.lname) AS 'name',s.subjectname,p.type,p.amount,p.date FROM cashier ca, payment p, lecturer l, subject s WHERE p.pay_cas_id=ca.cashier_id AND p.pay_sub_id=s.subject_id AND p.pay_lec_id=IF(p.pay_lec_id!=NULL,l.lecturer_id,l.lecturer_id) AND p.status='Paid' AND p.pay_id='".$payment_id."'");
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    return $data;
                } else {
                    return null;
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getPendingPayment($cashier_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT p.pay_id,CONCAT(st.fname, ' ' ,st.lname) AS 'name',s.subjectname,p.amount,p.date FROM cashier ca, payment p, student st, subject s WHERE p.pay_cas_id=ca.cashier_id AND p.pay_sub_id=s.subject_id AND p.pay_st_id=IF(p.pay_st_id!=NULL,st.student_id,st.student_id) AND p.status='Pending' AND p.pay_cas_id='".$cashier_id."' UNION SELECT p.pay_id,CONCAT(l.fname, ' ' ,l.lname) AS 'name',s.subjectname,p.amount,p.date FROM cashier ca, payment p, lecturer l, subject s WHERE p.pay_cas_id=ca.cashier_id AND p.pay_sub_id=s.subject_id AND p.pay_lec_id=IF(p.pay_lec_id!=NULL,l.lecturer_id,l.lecturer_id) AND p.status='Pending' AND p.pay_cas_id='".$cashier_id."'");
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    return $data;
                } else {
                    return null;
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function generateReceipt($list)
    {
        require('../plugins/fpdf17/fpdf.php');
        foreach($list as $item) {
            //A4 width : 219mm
			//default margin : 10mm each side
			//writable horizontal : 219-(10*2)=189mm

			$pdf = new FPDF('P','mm','A4');

			$pdf->AddPage();

			//set font to arial, bold, 14pt
			$pdf->SetFont('Arial','B',14);

			//Cell(width , height , text , border , end line , [align] )

			$pdf->Cell(130	,5,'Sipsewana EDU',0,0);
			$pdf->Cell(59	,5,'Payment Receipt',0,1);//end of line

			//set font to arial, regular, 12pt
			$pdf->SetFont('Arial','',12);

			$pdf->Cell(130	,5,'No 01, Ganemulla Road, Kadawatha, Sri Lanka',0,0);
			$pdf->Cell(59	,5,'',0,1);//end of line

			$pdf->Cell(130	,5,'Kadawatha, Sri Lanka, Postal Code:11850',0,0);
			$pdf->Cell(25	,5,'Date',0,0);
			$pdf->Cell(34	,5,date('Y-m-d'),0,1);//end of line

			$pdf->Cell(130	,5,'Phone +94 0112 456 355',0,0);
			$pdf->Cell(40	,5,'Receipt No #',0,0);
			$pdf->Cell(9	,5,$item['pay_id'],0,1,'R');//end of line

			$pdf->Cell(152	,5,'Cashier ID',0,0,'R');
			$pdf->Cell(27	,5,$_SESSION['id'],0,1,'R');//end of line

			//make a dummy empty cell as a vertical spacer
			$pdf->Cell(189	,10,'',0,1);//end of line

			//add dummy cell at beginning of each line for indentation
            $pdf->SetFont('Arial','B',12);
			//$pdf->Cell(10	,5,'',0,0);
			$pdf->Cell(130	,5,'Name: '.$item['name'],0,1);

			//$pdf->Cell(10	,5,'',0,0);
			$pdf->Cell(130	,5,'Type: '.$item['type'],0,1);

            $pdf->SetFont('Arial','',12);
            $pdf->Cell(189	,10,'',0,1);//end of line

            $pdf->Cell(60	,5,'Subject',1,0,'C');
            $pdf->Cell(60	,5,'Date',1,0,'C');
            $pdf->Cell(60	,5,'Amount',1,1,'C');

            $pdf->SetFont('Arial','B',13);

            $pdf->Cell(60	,8,$item['subjectname'],1,0,'C');
            $pdf->Cell(60	,8,$item['date'],1,0,'C');
            $pdf->Cell(60	,8,"Rs.".$item['amount'],1,0,'C');

			//make a dummy empty cell as a vertical spacer
			$pdf->Cell(189	,10,'',0,1);//end of line

            $pdf->Output();
        }
    }

    function updatepayment($payment_id, $date) {
        try {
            global $con;
            if($con->query("UPDATE payment SET date='".date("Y-m-d", strtotime($date))."' WHERE pay_id='".$payment_id."'")) {
                header('location:../pages/Cashier/ViewPayments/PendingPayments/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Updated Successfully";
            } else {
                header('location:../pages/Cashier/ViewPayments/PendingPayments/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function deletePayment($payment_id) {
        try {
            global $con;
            if($con->query("DELETE FROM payment WHERE pay_id='".$payment_id."'")) {
                header('location:../pages/Cashier/ViewPayments/PendingPayments/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully";
            } else {
                header('location:../pages/Cashier/ViewPayments/PendingPayments/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getPaymentCount($cashier_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) AS 'count' FROM cashier ca, payment p WHERE p.pay_cas_id=ca.cashier_id AND p.pay_cas_id='".$cashier_id."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $count = $row['count'];
                }
                return $count;
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

}
?>