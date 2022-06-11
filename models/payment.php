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
        private $pay_id;
        private $pay_st_id;
        private $pay_lec_id;
        private $method;
        private $status;
        private $type;
        private $amount;
        private $date;

        function setStPaymentID($student_id) {
            $this->pay_st_id = $student_id;
        }

        function setLecPaymentID($lecturer_id) {
            $this->pay_lec_id = $lecturer_id;
        }

        function setStPaymentSession()
        {
            header('location:../pages/Front Officer/Students/Payment/List.php');
            $_SESSION['stpaymentid']=$this->pay_st_id;
        }

        function setLecPaymentSession()
        {
            header('location:../pages/Front Officer/Lecturers/Payment/List.php');
            $_SESSION['lecpayid']=$this->pay_lec_id;
        }

        // function getStudentPayments($student_id)
        // {
        //     try {
        //         global $con;
        //         $data = array();
        //         $result = $con->query("SELECT p.pay_id,s.subjectname,MONTHNAME(p.date) as 'month',p.amount,p.date FROM payment p, subject s, student_reg sr WHERE p.pay_sub_id = sr.st_sub_id AND sr.st_sub_id = s.subject_id AND p.status = 'Pending' AND sr.st_reg_id = '".$student_id."'");
        //         if ($result) {
        //             if ($result->num_rows > 0) {
        //                 while ($row = $result->fetch_assoc()) {
        //                     $data[] = $row;
        //                 }
        //                 return $data;
        //             } else {
        //                 return null;
        //             }
        //         }
        //         $con->close();
        //     } catch (Exception $e) {
        //         echo 'Message: ' .$e->getMessage();
        //     }
            
        // }

        // function getStudentPaidPayments($student_id)
        // {
        //     try {
        //         global $con;
        //         $data = array();
        //         $result = $con->query("SELECT p.pay_id,s.subjectname,MONTHNAME(p.date) as 'month',p.amount,p.date FROM payment p, subject s, student_reg sr WHERE p.pay_sub_id = sr.st_sub_id AND sr.st_sub_id = s.subject_id AND p.status = 'Paid' AND sr.st_reg_id = '".$student_id."'");
        //         if ($result) {
        //             if ($result->num_rows > 0) {
        //                 while ($row = $result->fetch_assoc()) {
        //                     $data[] = $row;
        //                 }
        //                 return $data;
        //             } else {
        //                 return null;
        //             }
        //         }
        //         $con->close();
        //     } catch (Exception $e) {
        //         echo 'Message: ' .$e->getMessage();
        //     }
            
        // }

        // function getLecturerPaidPayments($lecturer_id)
        // {
        //     try {
        //         global $con;
        //         $data = array();
        //         $result = $con->query("SELECT p.pay_id,s.subjectname,MONTHNAME(p.date) as 'month',p.amount,p.date FROM payment p, subject s, lecturer_reg lr WHERE p.pay_sub_id = lr.lec_sub_id AND p.pay_lec_id = lr.lec_reg_id AND lr.lec_sub_id = s.subject_id AND p.status = 'Paid' AND lr.lec_reg_id = '".$lecturer_id."'");
        //         if ($result) {
        //             if ($result->num_rows > 0) {
        //                 while ($row = $result->fetch_assoc()) {
        //                     $data[] = $row;
        //                 }
        //                 return $data;
        //             } else {
        //                 return null;
        //             }
        //         }
        //         $con->close();
        //     } catch (Exception $e) {
        //         echo 'Message: ' .$e->getMessage();
        //     }
            
        // }

        // public function studentPay($pay_id, $student_id, $subjectName, $month, $amount, $date) {
        //     try {
        //         global $con;
        //         $verify = $this->verify($pay_id, $student_id, $subjectName, $month, $amount, $date);
        //         if($verify['status'] === true) {
        //             if($con->query("UPDATE payment SET status='Paid', date='".date("Y-m-d")."' WHERE pay_id='".$pay_id."' AND pay_sub_id = '".$verify['sub_id']."' AND MONTHNAME('".$date."') = '".$month."' AND status = 'Pending'")) {
        //                 header('location:../pages/Student/Payments/Pay/List.php');
        //                 $_SESSION['response']="success";
        //                 $_SESSION['message']="Paid Successfully";
        //             } else {
        //                 header('location:../pages/Student/Payments/Pay/List.php');
        //                 $_SESSION['response']="danger";
        //                 $_SESSION['message']="Database error occured!";
        //             }
        //         } else {
        //             header('location:../pages/Student/Payments/Pay/List.php');
        //             $_SESSION['response']="danger";
        //             $_SESSION['message']="No matching payment found";
        //         }
                
        //         $con->close();
        //     } catch (Exception $e) {
        //         echo 'Message: ' .$e->getMessage();
        //     }
        // }

        // public function verify($pay_id, $student_id, $subjectName, $month, $amount, $date) {
        //     try {
        //         include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
        //         $subject = new Subject();
        //         $subject_id = $subject->getId($subjectName);
        //         global $con;
        //         $result = $con->query("SELECT * FROM payment WHERE pay_id = '".$pay_id."' AND pay_sub_id = '".$subject_id."' AND MONTHNAME('".$date."') = '".$month."' AND status = 'Pending'");
        //         if ($result->num_rows > 0) {
        //             return [
        //                 'status' => true,
        //                 'sub_id' => $subject_id,
        //             ];
        //         } else {
        //             return false;
        //         }
        //         $con->close();
        //     } catch (Exception $e) {
        //         echo 'Message: ' .$e->getMessage();
        //     }
        // }

        // public function makeLecPayment($lecturer_id,$subject_id,$method,$type,$amount,$date) {
        //     try {
        //         $status = "Paid";
        //         global $con;
        //         if($con->query("INSERT INTO payment(method,status,type,amount,date,pay_sub_id,pay_lec_id,pay_cas_id) VALUES ('".$method."','".$status."','".$type."','".$amount."','".date("Y-m-d", strtotime($date))."','".$subject_id."','".$lecturer_id."','".$_SESSION['id']."')") === True) {
        //             header('location:../pages/Cashier/MakePayments/LecturerPayments/Make.php');
        //             $_SESSION['response']="success";
        //             $_SESSION['message']="Submitted Successfully!";
        //         } else {
        //             header('location:../pages/Cashier/MakePayments/LecturerPayments/Make.php');
        //             $_SESSION['response']="danger";
        //             $_SESSION['message']="Database Error!";
        //         }
        //         $con->close();
        //     } catch (Exception $e) {
        //         echo 'Message: ' .$e->getMessage();
        //     }
        // }

        public function makeStPayment($subject_id,$method,$type,$amount,$date) {
            try {
                $status = "Paid";
                $Qstatus = null;
                global $con;
                // foreach($studentList as $student) {
                //     if($con->query("INSERT INTO payment(method,status,type,amount,date,pay_sub_id,pay_st_id,pay_cas_id) VALUES ('".$method."','".$status."','".$type."','".$amount."','".date("Y-m-d", strtotime($date))."','".$subject_id."','".$student['st_reg_id']."','".$_SESSION['id']."')") === TRUE) {
                //         $Qstatus = true;
                //     } else {
                //         $Qstatus = false;
                //     }
                // }
                if($con->query("INSERT INTO payment(method,status,type,amount,date,pay_sub_id,pay_cas_id) VALUES ('".$method."','".$status."','".$type."','".$amount."','".date("Y-m-d", strtotime($date))."','".$subject_id."','".$_SESSION['id']."')") === TRUE) {
                    $Qstatus = true;
                } else {
                    $Qstatus = false;
                }
                if ($Qstatus === true) {
                    header('location:../pages/Cashier/MakePayments/ClassPayments/Make.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Submitted Successfully!";
                } else {
                    // header('location:../pages/Cashier/MakePayments/ClassPayments/Make.php');
                    // $_SESSION['response']="danger";
                    // $_SESSION['message']="Database error occured!";
                    echo "Error: ".$con->error;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
        
        function getPaidPaymentsList($paymentId)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT p.pay_id,s.subjectname,p.method,p.type,p.date,p.amount FROM payment p, subject s WHERE p.pay_sub_id=s.subject_id AND p.status='Paid' AND p.pay_id='".$paymentId."'");
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
    }

    // if (isset($_POST['pay'])) {
    //     if(empty($_POST['pay_id']) || empty($_POST['subject']) || empty($_POST['month']) || empty($_POST['amount']) || empty($_POST['date']) 
    //     || empty($_POST['reamount'])) {
    //         header('location:../pages/Student/Payments/Pay/List.php');
    //         $_SESSION['response']="danger";
    //         $_SESSION['message']="Please check the details before submit";
    //     } else {
    //         if($_POST['amount'] === $_POST['reamount']) {
    //             $payment = new Payment();
    //             $payment->studentPay($_POST['pay_id'],$_SESSION['id'],$_POST['subject'],$_POST['month'],$_POST['reamount'],$_POST['date']);
    //         } else {
    //             header('location:../pages/Student/Payments/Pay/List.php');
    //             $_SESSION['response']="danger";
    //             $_SESSION['message']="Please re enter the same amount";
    //         }
    
    //     }
    // }

    // if (isset($_POST['stpaymentSearch'])) {
    //     if (empty($_POST['paymentid'])) {
    //         header('location:../pages/Front Officer/Students/Payment/List.php');
    //         $_SESSION['response']="danger";
    //         $_SESSION['message']="Invalid payment ID!";
    //     } else {
    //         $payment = new Payment();
    //         $payment->setStPaymentID($_POST['paymentid']);
    //         $payment->setStPaymentSession();
    //     }
    // }

    // if (isset($_POST['lecpaymentSearch'])) {
    //     if (empty($_POST['paymentid'])) {
    //         header('location:../pages/Front Officer/Lecturers/Payment/List.php');
    //         $_SESSION['response']="danger";
    //         $_SESSION['message']="Invalid lecturer ID!";
    //     } else {
    //         $payment = new Payment();
    //         $payment->setLecPaymentID($_POST['paymentid']);
    //         $payment->setLecPaymentSession();
    //     }
    // }

    // if (isset($_POST['makeLecPayment'])) {
    //     if (empty($_POST['subname']) || empty($_POST['method']) || empty($_POST['type']) ||
    //     empty($_POST['amount']) || empty($_POST['date'])) {
    //         header('location:../pages/Cashier/MakePayments/LecturerPayments/Make.php');
    //         $_SESSION['response']="danger";
    //         $_SESSION['message']="Please fill the relevant details!";
    //     } else {
    //         include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
    //         include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/lecturer_reg.php";
    //         $subject = new Subject();
    //         $subject_id = $subject->getId($_POST['subname']);
    //         $lecturer_reg = new LecturerReg();
    //         if ($lecturer_reg->getLecturerRegId($subject_id) === null) {
    //             header('location:../pages/Cashier/MakePayments/LecturerPayments/Make.php');
    //             $_SESSION['response']="danger";
    //             $_SESSION['message']="Lecturer not found for this subject!";
    //         } else {
    //             $lecturer_id = $lecturer_reg->getLecturerRegId($subject_id);
    //             $payment = new Payment();
    //             $payment->makeLecPayment($lecturer_id,$subject_id,$_POST['method'],$_POST['type'],$_POST['amount'],$_POST['date']);
    //         }
    //     }
    // }

    if (isset($_POST['makePayment'])) {
        if (empty($_POST['subname']) || empty($_POST['method']) || empty($_POST['type']) ||
        empty($_POST['amount']) || empty($_POST['date'])) {
            header('location:../pages/Cashier/MakePayments/ClassPayments/Make.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please fill the relevant details!";
        } else {
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/student_reg.php";
            $subject = new Subject();
            if($_POST['type'] == 'Class Fees') {
                $fee = $subject->getFee($_POST['subname'])+1000;
                if ($fee != $_POST['amount']) {
                    header('location:../pages/Cashier/MakePayments/ClassPayments/Make.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Please enter the correct Amount!";
                }
            }
            else {
                //$subject_id = $subject->getId($_POST['subname']);
                //$student_reg = new StudentReg();
                // if ($student_reg->getStudentRegId($subject_id) === null) {
                //     header('location:../pages/Cashier/MakePayments/ClassPayments/Make.php');
                //     $_SESSION['response']="danger";
                //     $_SESSION['message']="No Students found for this subject!";
                // } else {
                //     $studentList = array();
                //     $studentList = $student_reg->getStudentRegId($subject_id);
                //     $payment = new Payment();
                //     //$payment->makeStPayment($studentList,$subject_id,$_POST['method'],$_POST['type'],$_POST['amount'],$_POST['date']);
                    
                // }
                $subject_id = $subject->getId($_POST['subname']);
                $payment = new Payment();
                $payment->makeStPayment($subject_id,$_POST['method'],$_POST['type'],$_POST['amount'],$_POST['date']);
            }
        }
    }
}
else
{
    header('location:../pages/Student/Login.php');
}

?>