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
else if(isset($_POST['SubStuRegReport']))
{
    if(empty($_POST['frmdate']) || empty($_POST['todate'])) {
        header('location:../pages/Director/Student/Registration/Report.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $list = $director->getStuRegistrationList($_POST['frmdate'],$_POST['todate']);
        if ($list === null) {
            header('location:../pages/Director/Student/Registration/Report.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="No records found!";
        } else {
            $director->generateStRegReport($list,$_POST['frmdate'],$_POST['todate']);
        }
    }
}
else if(isset($_POST['paymentReport']))
{
    //echo $_POST['paymentid'];
    if(empty($_POST['paymentid'])) {
        header('location:../pages/Director/Payment/Receipt/Report.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Payment Id cannot be blank!";
    } else {
        // include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/student_reg.php";
        // $student_reg = new StudentReg();
        // if ($student_reg->getStuRegID($_POST['studentid']) === null) {
        //     header('location:../pages/Director/Student/Payment/Report.php');
        //     $_SESSION['response']="danger";
        //     $_SESSION['message']="Invalid studdent ID!";
        // } else {
        //     include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/student.php";
        //     $student = new Student();
        //     $studentname = $student->getName($_POST['studentid']);
        //     include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/payment.php";
        //     $payment = new Payment();
        //     $list = $payment->getStudentPaidPaymentsList($_POST['studentid']);
        //     if ($list === null) {
        //         header('location:../pages/Director/Student/Payment/Report.php');
        //         $_SESSION['response']="danger";
        //         $_SESSION['message']="No records found!";
        //     } else {
        //         $director->generateStPayReport($studentname,$_POST['studentid'],$list);
        //     }
        // }
        include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/payment.php";
        $payment = new Payment();
        $list = $payment->getPaidPaymentsList($_POST['paymentid']);
        if ($list === null) {
            header('location:../pages/Director/Payment/Receipt/Report.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="No records found!";
        } else {
            $director->generatePayReport($list);
        }
    }
}
else if(isset($_POST['SubLecRegReport']))
{
    if(empty($_POST['frmdate']) || empty($_POST['todate'])) {
        header('location:../pages/Director/Lecturer/Registration/Report.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $list = $director->getLecRegistrationList($_POST['frmdate'],$_POST['todate']);
        if ($list === null) {
            header('location:../pages/Director/Lecturer/Registration/Report.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="No records found!";
        } else {
            $director->generateLecRegReport($list,$_POST['frmdate'],$_POST['todate']);
        }
    }
}

else if(isset($_POST['paymentreport']))
{
    if(empty($_POST['frmdate']) || empty($_POST['todate'])) {
        header('location:../pages/Director/Payment/Report/Report.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $list = $director->getPaymentList($_POST['frmdate'],$_POST['todate']);
        if ($list === null) {
            header('location:../pages/Director/Payment/Report/Report.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="No records found!";
        } else {
            $total = $director->getTotalPaymentList($_POST['frmdate'],$_POST['todate']);
            $director->generatePaymentReport($list,$_POST['frmdate'],$_POST['todate'],$total);
        }
    }
}


class Director
{
    // properties
    private $fname;
    private $lname;
    private $usrname;
    private $passwordHash;
    private $dob;
    private $email;
    private $contactNo;

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

    function getStuRegistrationList($fromDate,$toDate)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT st.student_id,CONCAT(st.fname, ' ' ,st.lname) AS 'studentname',s.subjectname,sr.registrationdate FROM student st, student_reg sr, subject s WHERE st.student_id=sr.st_reg_id AND sr.st_sub_id=s.subject_id AND sr.registrationdate BETWEEN '".$fromDate."'AND '".$toDate."'");
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

    function getLecRegistrationList($fromDate,$toDate)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT l.lecturer_id,CONCAT(l.fname, ' ' ,l.lname) AS 'lecturername',s.subjectname,lr.registrationdate FROM lecturer l, lecturer_reg lr, subject s WHERE l.lecturer_id=lr.lec_reg_id AND lr.lec_sub_id=s.subject_id AND lr.registrationdate BETWEEN '".$fromDate."' AND '".$toDate."'");
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

    function getPaymentList($fromDate,$toDate)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT s.subject_id,s.subjectname,CONCAT(l.fname,' ',l.lname) AS 'lecturername',SUM(p.amount) AS 'amount' FROM payment p, subject s, lecturer l, lecturer_reg lr WHERE p.pay_sub_id=s.subject_id AND lr.lec_reg_id=l.lecturer_id AND lr.lec_sub_id=s.subject_id AND p.type='Class Fees' AND p.date BETWEEN '".$fromDate."' AND '".$toDate."' GROUP BY p.pay_sub_id");
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

    function getTotalPaymentList($fromDate,$toDate)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT SUM(p.amount) AS 'amount' FROM payment p WHERE p.type='Class Fees' AND p.date BETWEEN '".$fromDate."' AND '".$toDate."'");
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

    function getPaymentIdList()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT p.pay_id FROM payment p");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row = array_map('stripslashes', $row);
                    $data[] = $row;
                }
                return $data;
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

    function generateStRegReport($list,$fromDate,$toDate)
    {
        require('../plugins/fpdf17/fpdf.php');
        //A4 width : 219mm
        //default margin : 10mm each side
        //writable horizontal : 219-(10*2)=189mm

        $pdf = new FPDF('P','mm','A4');

        $pdf->AddPage();

        $pdf->Image('../dist/img/dashboardImages/sipsewanaLogo.jpg',10,10,-300);
        $pdf->Cell(189	,10,'',0,1);
        $pdf->Cell(189	,10,'',0,1);
        $pdf->Cell(189	,10,'',0,1);

        //set font to arial, bold, 14pt
        $pdf->SetFont('Arial','B',14);

        //Cell(width , height , text , border , end line , [align] )

        $pdf->Cell(130	,5,'Sipsewana EDU',0,0);
        $pdf->Cell(59	,5,'System Generated Report',0,1);//end of line

        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial','',12);

        $pdf->Cell(130	,5,'No 01, Ganemulla Road, Kadawatha, Sri Lanka',0,0);
        $pdf->Cell(59	,5,'',0,1);//end of line

        $pdf->Cell(130	,5,'Kadawatha, Sri Lanka, Postal Code:11850',0,0);
        $pdf->Cell(25	,5,'Date',0,0);
        $pdf->Cell(34	,5,date('Y-m-d'),0,1);//end of line

        $pdf->Cell(130	,5,'Phone +94 0112 456 355',0,0);

        $pdf->Cell(22	,5,'Director ID',0,0,'R');
        $pdf->Cell(27	,5,$_SESSION['id'],0,1,'R');//end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        //add dummy cell at beginning of each line for indentation
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(10	,5,'',0,0);
        $pdf->Cell(152	,5,'Student Registration Report from '.$fromDate.' to '.$toDate,0,1,'C');

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(189	,10,'',0,1);//end of line

        $pdf->Cell(45	,5,'Student ID',1,0,'C');
        $pdf->Cell(45	,5,'Student Name',1,0,'C');
        $pdf->Cell(45	,5,'Subject Name',1,0,'C');
        $pdf->Cell(45	,5,'Registration Date',1,1,'C');

        $pdf->SetFont('Arial','',10);

        foreach($list as $item) {
            $pdf->Cell(45	,5,$item['student_id'],1,0,'C');
            $pdf->Cell(45	,5,$item['studentname'],1,0,'');
            $pdf->Cell(45	,5,$item['subjectname'],1,0,'');
            $pdf->Cell(45	,5,$item['registrationdate'],1,1,'');
        }

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        $pdf->Output();
    }

    function generatePayReport($list)
    {
        $director_name = $this->getName($_SESSION['id']);
        require('../plugins/fpdf17/fpdf.php');
        //A4 width : 219mm
        //default margin : 10mm each side
        //writable horizontal : 219-(10*2)=189mm

        $pdf = new FPDF('P','mm','A4');

        $pdf->AddPage();

        $pdf->Image('../dist/img/dashboardImages/sipsewanaLogo.jpg',10,10,-300);
        $pdf->Cell(189	,10,'',0,1);
        $pdf->Cell(189	,10,'',0,1);
        $pdf->Cell(189	,10,'',0,1);

        //set font to arial, bold, 14pt
        $pdf->SetFont('Arial','B',14);

        //Cell(width , height , text , border , end line , [align] )

        $pdf->Cell(130	,5,'Sipsewana EDU',0,0);
        $pdf->Cell(59	,5,'System Generated Report',0,1);//end of line

        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial','',12);

        $pdf->Cell(130	,5,'No 01, Ganemulla Road, Kadawatha, Sri Lanka',0,0);
        $pdf->Cell(59	,5,'',0,1);//end of line

        $pdf->Cell(130	,5,'Kadawatha, Sri Lanka, Postal Code:11850',0,0);
        $pdf->Cell(25	,5,'Date',0,0);
        $pdf->Cell(34	,5,date('Y-m-d'),0,1);//end of line

        $pdf->Cell(130	,5,'Phone +94 0112 456 355',0,0);

        $pdf->Cell(18	,5,'Director ',0,0,'R');
        $pdf->Cell(30	,5,$director_name,0,1,'R');//end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        //add dummy cell at beginning of each line for indentation
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(10	,5,'',0,0);
        $pdf->Cell(152	,5,'Payment Receipt',0,1,'C');

        // $pdf->SetFont('Arial','B',12);
        // $pdf->Cell(10	,5,'',0,1);
        // $pdf->Cell(130	,5,'Student Name: '.$studentname,0,1);
        // $pdf->Cell(130	,5,'Student ID: '.$student_id,0,1);

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(189	,10,'',0,1);//end of line

        $pdf->Cell(31	,5,'Payment ID',1,0,'C');
        $pdf->Cell(31	,5,'Subject Name',1,0,'C');
        $pdf->Cell(31	,5,'Method',1,0,'C');
        $pdf->Cell(31	,5,'Type',1,0,'C');
        $pdf->Cell(31	,5,'Date',1,0,'C');
        $pdf->Cell(31	,5,'Amount',1,1,'C');

        $pdf->SetFont('Arial','',10);

        foreach($list as $item) {
            $pdf->Cell(31	,5,$item['pay_id'],1,0,'C');
            $pdf->Cell(31	,5,$item['subjectname'],1,0,'');
            $pdf->Cell(31	,5,$item['method'],1,0,'');
            $pdf->Cell(31	,5,$item['type'],1,0,'');
            $pdf->Cell(31	,5,$item['date'],1,0,'');
            $pdf->Cell(31	,5,'Rs.'.$item['amount'],1,1,'');
        }

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        $pdf->Output();
    }

    function generateLecRegReport($list,$fromDate,$toDate)
    {
        require('../plugins/fpdf17/fpdf.php');
        //A4 width : 219mm
        //default margin : 10mm each side
        //writable horizontal : 219-(10*2)=189mm

        $pdf = new FPDF('P','mm','A4');

        $pdf->AddPage();

        $pdf->Image('../dist/img/dashboardImages/sipsewanaLogo.jpg',10,10,-300);
        $pdf->Cell(189	,10,'',0,1);
        $pdf->Cell(189	,10,'',0,1);
        $pdf->Cell(189	,10,'',0,1);

        //set font to arial, bold, 14pt
        $pdf->SetFont('Arial','B',14);

        //Cell(width , height , text , border , end line , [align] )

        $pdf->Cell(130	,5,'Sipsewana EDU',0,0);
        $pdf->Cell(59	,5,'System Generated Report',0,1);//end of line

        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial','',12);

        $pdf->Cell(130	,5,'No 01, Ganemulla Road, Kadawatha, Sri Lanka',0,0);
        $pdf->Cell(59	,5,'',0,1);//end of line

        $pdf->Cell(130	,5,'Kadawatha, Sri Lanka, Postal Code:11850',0,0);
        $pdf->Cell(25	,5,'Date',0,0);
        $pdf->Cell(34	,5,date('Y-m-d'),0,1);//end of line

        $pdf->Cell(130	,5,'Phone +94 0112 456 355',0,0);

        $pdf->Cell(22	,5,'Director ID',0,0,'R');
        $pdf->Cell(27	,5,$_SESSION['id'],0,1,'R');//end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        //add dummy cell at beginning of each line for indentation
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(10	,5,'',0,0);
        $pdf->Cell(152	,5,'Lecturer Registration Report from '.$fromDate.' to '.$toDate,0,1,'C');

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(189	,10,'',0,1);//end of line

        $pdf->Cell(45	,5,'Lecturer ID',1,0,'C');
        $pdf->Cell(45	,5,'Lecturer Name',1,0,'C');
        $pdf->Cell(45	,5,'Subject Name',1,0,'C');
        $pdf->Cell(45	,5,'Registration Date',1,1,'C');

        $pdf->SetFont('Arial','',10);

        foreach($list as $item) {
            $pdf->Cell(45	,5,$item['lecturer_id'],1,0,'C');
            $pdf->Cell(45	,5,$item['lecturername'],1,0,'');
            $pdf->Cell(45	,5,$item['subjectname'],1,0,'');
            $pdf->Cell(45	,5,$item['registrationdate'],1,1,'');
        }

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        $pdf->Output();
    }

    function generatePaymentReport($list,$fromDate,$toDate,$total)
    {
        $director_name = $this->getName($_SESSION['id']);
        require('../plugins/fpdf17/fpdf.php');
        //A4 width : 219mm
        //default margin : 10mm each side
        //writable horizontal : 219-(10*2)=189mm

        $pdf = new FPDF('P','mm','A4');

        $pdf->AddPage();

        $pdf->Image('../dist/img/dashboardImages/sipsewanaLogo.jpg',10,10,-300);
        $pdf->Cell(189	,10,'',0,1);
        $pdf->Cell(189	,10,'',0,1);
        $pdf->Cell(189	,10,'',0,1);
        //set font to arial, bold, 14pt
        $pdf->SetFont('Arial','B',14);

        //Cell(width , height , text , border , end line , [align] )

        $pdf->Cell(130	,5,'Sipsewana EDU',0,0);
        $pdf->Cell(59	,5,'System Generated Report',0,1);//end of line

        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial','',12);

        $pdf->Cell(130	,5,'No 01, Ganemulla Road, Kadawatha, Sri Lanka',0,0);
        $pdf->Cell(59	,5,'',0,1);//end of line

        $pdf->Cell(130	,5,'Kadawatha, Sri Lanka, Postal Code:11850',0,0);
        $pdf->Cell(25	,5,'Date',0,0);
        $pdf->Cell(34	,5,date('Y-m-d'),0,1);//end of line

        $pdf->Cell(130	,5,'Phone +94 0112 456 355',0,0);

        $pdf->Cell(18	,5,'Director ',0,0,'R');
        $pdf->Cell(30	,5,$director_name,0,1,'R');//end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        //add dummy cell at beginning of each line for indentation
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(10	,5,'',0,0);
        $pdf->Cell(152	,5,'Class Fee Payment Report from '.$fromDate.' to '.$toDate,0,1,'C');

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(189	,10,'',0,1);//end of line

        $pdf->Cell(45	,5,'Subject ID',1,0,'C');
        $pdf->Cell(45	,5,'Subject Name',1,0,'C');
        $pdf->Cell(45	,5,'Lecturer Name',1,0,'C');
        $pdf->Cell(45	,5,'Amount',1,1,'C');

        $pdf->SetFont('Arial','',10);

        foreach($list as $item) {
            $pdf->Cell(45	,5,$item['subject_id'],1,0,'C');
            $pdf->Cell(45	,5,$item['subjectname'],1,0,'');
            $pdf->Cell(45	,5,$item['lecturername'],1,0,'');
            $pdf->Cell(45	,5,'Rs.'.$item['amount'],1,1,'');
        }
        $totalAmount = null;
        foreach($total as $item) {
            $totalAmount = $item['amount'];
        }
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(135	,5,'Total Amount',0,0,'R');
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(45	,5,'Rs.'.$totalAmount,0,1,'L');
        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        $pdf->Output();
    }

    function getRegisteredStudentCount()
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) AS 'count' FROM student st WHERE st.usrname IS NOT NULL AND st.passwordhash IS NOT NULL");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $count = $row['count'];
                }
                return $count;
            } elseif ($result === false) {
                throw new Exception("Database Error!");
            } else {
                return 0;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        
    }

    function getRegisteredLecturerCount()
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) AS 'count' FROM lecturer l WHERE l.usrname IS NOT NULL AND l.passwordhash IS NOT NULL");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $count = $row['count'];
                }
                return $count;
            } elseif ($result === false) {
                throw new Exception("Database Error!");
            } else {
                return 0;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        
    }
}
?>