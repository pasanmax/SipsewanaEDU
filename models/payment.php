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

    class Payment
    {
        protected $pay_id;
        protected $pay_st_id;
        protected $pay_lec_id;
        protected $method;
        protected $status;
        protected $type;
        protected $amount;
        protected $date;

        function setStPaymentID($student_id) {
            $this->pay_st_id = $student_id;
        }

        function setLecPaymentID($lecturer_id) {
            $this->pay_lec_id = $lecturer_id;
        }

        function setStPaymentSession()
        {
            header('location:../pages/Front Officer/Students/Payment/List.php');
            $_SESSION['stpayid']=$this->pay_st_id;
        }

        function setLecPaymentSession()
        {
            header('location:../pages/Front Officer/Lecturers/Payment/List.php');
            $_SESSION['lecpayid']=$this->pay_lec_id;
        }

        function getStudentPayments($student_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT p.pay_id,s.subjectname,MONTHNAME(p.date) as 'month',p.amount,p.date FROM payment p, subject s, student_reg sr WHERE p.pay_sub_id = sr.st_sub_id AND p.pay_st_id = sr.st_reg_id AND sr.st_sub_id = s.subject_id AND p.status = 'Pending' AND sr.st_reg_id = '".$student_id."'");
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

        function getStudentPaidPayments($student_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT p.pay_id,s.subjectname,MONTHNAME(p.date) as 'month',p.amount,p.date FROM payment p, subject s, student_reg sr WHERE p.pay_sub_id = sr.st_sub_id AND p.pay_st_id = sr.st_reg_id AND sr.st_sub_id = s.subject_id AND p.status = 'Paid' AND sr.st_reg_id = '".$student_id."'");
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

        function getLecturerPaidPayments($lecturer_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT p.pay_id,s.subjectname,MONTHNAME(p.date) as 'month',p.amount,p.date FROM payment p, subject s, lecturer_reg lr WHERE p.pay_sub_id = lr.lec_sub_id AND p.pay_lec_id = lr.lec_reg_id AND lr.lec_sub_id = s.subject_id AND p.status = 'Paid' AND lr.lec_reg_id = '".$lecturer_id."'");
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

        public function studentPay($pay_id, $student_id, $subjectName, $month, $amount, $date) {
            try {
                global $con;
                $verify = $this->verify($pay_id, $student_id, $subjectName, $month, $amount, $date);
                if($verify['status'] === true) {
                    if($con->query("UPDATE payment SET status='Paid' WHERE pay_id='".$pay_id."' AND pay_st_id='".$student_id."' AND pay_sub_id = '".$verify['sub_id']."' AND MONTHNAME('".$date."') = '".$month."' AND status = 'Pending'")) {
                        header('location:../pages/Student/Payments/Pay/List.php');
                        $_SESSION['response']="success";
                        $_SESSION['message']="Paid Successfully";
                    } else {
                        header('location:../pages/Student/Payments/Pay/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Database error occured!";
                    }
                } else {
                    header('location:../pages/Student/Payments/Pay/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="No matching payment found";
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        public function verify($pay_id, $student_id, $subjectName, $month, $amount, $date) {
            try {
                include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                $subject = new Subject();
                $subject_id = $subject->getId($subjectName);
                global $con;
                $result = $con->query("SELECT * FROM payment WHERE pay_id = '".$pay_id."' AND pay_st_id = '".$student_id."' AND pay_sub_id = '".$subject_id."' AND MONTHNAME('".$date."') = '".$month."' AND status = 'Pending'");
                if ($result->num_rows > 0) {
                    return [
                        'status' => true,
                        'sub_id' => $subject_id,
                    ];
                } else {
                    return false;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    if (isset($_POST['pay'])) {
        if(empty($_POST['pay_id']) || empty($_POST['subject']) || empty($_POST['month']) || empty($_POST['amount']) || empty($_POST['date']) 
        || empty($_POST['reamount'])) {
            header('location:../pages/Student/Payments/Pay/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please check the details before submit";
        } else {
            if($_POST['amount'] === $_POST['reamount']) {
                $payment = new Payment();
                $payment->studentPay($_POST['pay_id'],$_SESSION['id'],$_POST['subject'],$_POST['month'],$_POST['reamount'],$_POST['date']);
            } else {
                header('location:../pages/Student/Payments/Pay/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Please re enter the same amount";
            }
    
        }
    }

    if (isset($_POST['stpaymentSearch'])) {
        if (empty($_POST['studentid'])) {
            header('location:../pages/Front Officer/Students/Payment/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Invalid student ID!";
        } else {
            $payment = new Payment();
            $payment->setStPaymentID($_POST['studentid']);
            $payment->setStPaymentSession();
        }
    }

    if (isset($_POST['lecpaymentSearch'])) {
        if (empty($_POST['lecturerid'])) {
            header('location:../pages/Front Officer/Lecturers/Payment/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Invalid lecturer ID!";
        } else {
            $payment = new Payment();
            $payment->setLecPaymentID($_POST['lecturerid']);
            $payment->setLecPaymentSession();
        }
    }
}
else
{
    header('location:../pages/Student/Login.php');
}

?>