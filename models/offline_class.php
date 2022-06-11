<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    require_once 'class.php';
    $conn = new Conn();
    $con = $conn->getConn();

    class Offline_Class extends Class_
    {
        // properties
        private $hallno;

        //methods
        public function setHallNo($hallNo)
        {
            $this->hallno = $hallNo;
        }

        public function saveOfflineClass($duration,$starttime,$date,$lecturer_id,$subject_id)
        {
            //$this->setHallNo($hallNo);
            parent::setClass($duration,$starttime);
            $duration = $this->duration;
            $starttime = date("h:m:s", strtotime($this->starttime));
            $endtime = date("h:m:s", strtotime($this->endtime));
            $hallNo = $this->hallno;
            //$date = date('Y-m-d', strtotime($date));
            // echo $duration;
            // echo "<br>";
            // echo $starttime;
            // echo "<br>";
            // echo $endtime;
            // echo "<br>";
            // echo $class_url;
            // echo "<br>";
            // echo $lecturer_id;
            // echo "<br>";
            // echo $subject_id;
            // echo "<br>";
            // echo $date;
            // echo "<br>";
            // echo date('Y-m-d', strtotime($date));
            try {
                global $con;
                if($con->query("INSERT INTO class (duration,starttime,endtime,lec_cls_id,sub_cls_id) VALUES ($duration,'".$starttime."','".$endtime."',$lecturer_id,$subject_id)") === TRUE) {
                    if(parent::getLastID() !== null) {
                        $class_id = parent::getLastID();
                        if($con->query("INSERT INTO class_dates (cls_dt_id,date) VALUES ('$class_id','".date("Y-m-d", strtotime($date))."')") === TRUE
                        && $con->query("INSERT INTO offline_class (of_cls_id,hallno) VALUES ('$class_id','$hallNo')") === TRUE) {
                            header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
                            $_SESSION['response']="success";
                            $_SESSION['message']="Created Successfully!";
                        } else {
                            header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
                            $_SESSION['response']="danger";
                            $_SESSION['message']="Database error occured!";
                            //echo "Error: ".$con->error;
                        }
                    } else {
                        header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="ID not found!";
                    }
                } else {
                    header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                    //echo "Error: ".$con->error;
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        public function updateOfflineClass($duration,$starttime,$date,$lecturer_id,$subject_id,$class_id)
        {
            //$this->setHallNo($hallNo);
            parent::setClass($duration,$starttime);
            $duration = $this->duration;
            $starttime = date("h:m:s", strtotime($this->starttime));
            $endtime = date("h:m:s", strtotime($this->endtime));
            // $starttime = $this->starttime;
            // $endtime = $this->endtime;
            $hallNo = $this->hallno;
            //$date = date('Y-m-d', strtotime($date));
            // echo $duration;
            // echo "<br>";
            // echo $starttime;
            // echo "<br>";
            // echo $endtime;
            // echo "<br>";
            // echo $class_url;
            // echo "<br>";
            // echo $lecturer_id;
            // echo "<br>";
            // echo $subject_id;
            // echo "<br>";
            // echo $date;
            // echo "<br>";
            // echo date('Y-m-d', strtotime($date));
            try {
                global $con;
                if($con->query("UPDATE class SET duration='".$duration."',starttime='".$starttime."',endtime='".$endtime."',lec_cls_id='".$lecturer_id."',sub_cls_id='".$subject_id."' WHERE class_id='".$class_id."'") === TRUE) {
                    if($con->query("UPDATE class_dates SET date='".date("Y-m-d", strtotime($date))."' WHERE cls_dt_id='".$class_id."'") === TRUE
                    && $con->query("UPDATE offline_class SET hallno='".$hallNo."' WHERE of_cls_id='".$class_id."'") === TRUE) {
                        header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
                        $_SESSION['response']="success";
                        $_SESSION['message']="Updated Successfully!";
                    } else {
                        header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Database error occured!";
                        //echo "Error: ".$con->error;
                    }
                } else {
                    header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                    //echo "Error: ".$con->error;
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        public function deleteOfflineClass($class_id)
        {
            try {
                global $con;
                if($con->query("DELETE FROM class WHERE class_id='".$class_id."'") === TRUE) {
                    header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Deleted Successfully!";
                } else {
                    header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                    //echo "Error: ".$con->error;
                }
                    // header('location:../pages/Student/Register/Register.php');
                    // $_SESSION['response']="danger";
                    // $_SESSION['message']="Please enter the valid registration amount";
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    if(isset($_POST['offlineclass']))
    {
        if(empty($_POST['subname']) || empty($_POST['hallno']) || empty($_POST['date']) || empty($_POST['duration']) 
        || empty($_POST['starttime'])) {
            header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please fill the details!";
        } else {
            $offline_class = new Offline_Class();
            $offline_class->setHallNo($_POST['hallno']);
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
            $subject = new Subject();
            $subject_id = $subject->getId($_POST['subname']);
            $offline_class->saveOfflineClass($_POST['duration'],$_POST['starttime'],$_POST['date'],$_SESSION['id'],$subject_id);
        }
    }

    if(isset($_POST['updateOfflineclass']))
    {
        if(empty($_POST['usubname']) || empty($_POST['uhallno']) || empty($_POST['udate']) || empty($_POST['uduration']) 
        || empty($_POST['ustarttime'])) {
            header('location:../pages/Lecturer/Classes/ManageOffline/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please fill the details!";
        } else {
            $offline_class = new Offline_Class();
            $offline_class->setHallNo($_POST['uhallno']);
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
            $subject = new Subject();
            $subject_id = $subject->getId($_POST['usubname']);
            $offline_class->updateOfflineClass($_POST['uduration'],$_POST['ustarttime'],$_POST['udate'],$_SESSION['id'],$subject_id,$_POST['uclassid']);
        }
    }

    if(isset($_GET['delClass']))
    {
        $offline_class = new Offline_Class();
        $offline_class->deleteOfflineClass($_GET['delClass']);
    }
}
else
{
    header('location:../pages/Student/Login.php');
}
?>