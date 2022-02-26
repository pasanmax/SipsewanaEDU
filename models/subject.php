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

    class Subject
    {
        protected $subject_id;
        protected $subjectname;
        protected $description;
        protected $fee;
        protected $type;
        protected $medium;

        function setSubject($subjectname,$description,$fee,$type,$medium)
        {
            $this->subjectname = $subjectname;
            $this->description = $description;
            $this->fee = $fee;
            $this->type = $type;
            $this->medium = $medium;
        }

        function setSubjectId($subject_id)
        {
            $this->subject_id = $subject_id;
        }

        function setStSubjectIdSession()
        {
            header('location:../pages/Front Officer/Subjects/EnrolledStudents/List.php');
            $_SESSION['stsub']=$this->subject_id;
        }

        function setLecSubjectIdSession()
        {
            header('location:../pages/Front Officer/Subjects/AssignedLecturers/List.php');
            $_SESSION['lecsub']=$this->subject_id;
        }

        function add()
        {
            try {
                global $con;
                $subjectname = $this->subjectname;
                $description = $this->description;
                $fee = $this->fee;
                $medium = $this->medium;
                $type = $this->type;
                $frt_sub_id = $_SESSION['id'];
                
                if($con->query("INSERT INTO subject (subjectname,description,fee,medium,type,frt_sub_id) VALUES ('$subjectname','$description','$fee','$medium','$type','$frt_sub_id')") === TRUE) {
                    header('location:../pages/Front Officer/Subjects/Add/Add.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Entered Successfully!";
                } else {
                    header('location:../pages/Front Officer/Subjects/Add/Add.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                    //echo "Error: ".$con->error;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function getId($subject_name)
        {
            try {
                global $con;
                $result = $con->query("SELECT subject.subject_id FROM subject WHERE subjectname='".$subject_name."'");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['subject_id'];
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

        function getSubName()
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT subject.subjectname FROM subject");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
                            $data[] = $row;
                        }
                        return $data;
                    } else {
                        return null;
                    }
                }
                // $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function getSType($student_id)
        {
            try {
                global $con;
                $result = $con->query("SELECT s.type FROM student_reg sr, subject s WHERE sr.st_sub_id=s.subject_id AND sr.st_reg_id='".$student_id."'");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $type = $row['type'];
                    }
                    return $type;
                } else {
                    return null;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function getRegSubName($student_id)
        {
            $type = $this->getSType($student_id);
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT DISTINCT subject.subjectname FROM student_reg,subject WHERE subject.subject_id!=(SELECT subject.subject_id FROM student_reg,subject WHERE student_reg.st_sub_id=subject.subject_id AND student_reg.st_reg_id='".$student_id."') AND subject.type='".$type."'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
                            $data[] = $row;
                        }
                        return $data;
                    } else {
                        return null;
                    }
                }
                // $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
            
        }

        function getRegSubNameLec($lecturer_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT DISTINCT s.subjectname FROM lecturer_reg lr, subject s WHERE s.subject_id NOT IN (SELECT s.subject_id FROM lecturer_reg lr, subject s WHERE lr.lec_sub_id=s.subject_id AND lr.lec_reg_id='".$lecturer_id."');-- AND s.type='O/L'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
                            $data[] = $row;
                        }
                        return $data;
                    } else {
                        return null;
                    }
                }
                // $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
            
        }

        function getRegSubNameL($lecturer_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT s.subjectname FROM lecturer_reg lr, subject s WHERE lr.lec_sub_id=s.subject_id AND lr.lec_reg_id='".$lecturer_id."'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
                            $data[] = $row;
                        }
                        return $data;
                    } else {
                        return null;
                    }
                }
                // $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
            
        }

        function getFee($subject_name)
        {
            try {
                global $con;
                $result = $con->query("SELECT subject.fee FROM subject WHERE subject.subjectname='".$subject_name."'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $fee = $row['fee'];
                        }
                        return $fee;
                    } else {
                        return null;
                    }
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function getRegFee($student_id)
        {
            try {
                $type = $this->getSType($student_id);
                global $con;
                $data = array();
                $result = $con->query("SELECT DISTINCT subject.fee FROM student_reg,subject WHERE subject.subject_id NOT IN (SELECT subject.subject_id FROM student_reg,subject WHERE student_reg.st_sub_id=subject.subject_id AND student_reg.st_reg_id='".$student_id."') AND subject.type='".$type."'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
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

        function getLRegFee($lecturer_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT DISTINCT s.fee FROM lecturer_reg lr, subject s WHERE s.subject_id NOT IN (SELECT s.subject_id FROM lecturer_reg lr, subject s WHERE lr.lec_sub_id=s.subject_id AND lr.lec_reg_id='".$lecturer_id."');-- AND s.type='O/L'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
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

        function getOLSubjects()
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT s.subjectname FROM subject s WHERE s.type='O/L'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
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

        function getALSubjects()
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT s.subjectname FROM subject s WHERE s.type='A/L'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
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

        function getSubjects()
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT s.subjectname FROM subject s");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
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

    if(isset($_POST['addSubject']))
    {
        if(empty($_POST['subjectname']) || empty($_POST['fee']) || empty($_POST['medium']) || empty($_POST['type'])) {
            header('location:../pages/Front Officer/Subjects/Add/Add.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please fill the relevant details!";
        } else {
            $subject = new Subject();
            $subject->setSubject($_POST['subjectname'],$_POST['description'],$_POST['fee'],$_POST['type'],$_POST['medium']);
            $subject->add();
        }
    }
    else if (isset($_POST['stsubSearch'])) {
        if(empty($_POST['subjectid'])) {
            header('location:../pages/Front Officer/Subjects/EnrolledStudents/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please enter Subject ID";
        } else {
            $subject = new Subject();
            $subject->setSubjectId($_POST['subjectid']);
            $subject->setStSubjectIdSession();
        }
    }
    else if (isset($_POST['lecsubSearch'])) {
        if(empty($_POST['subjectid'])) {
            header('location:../pages/Front Officer/Subjects/AssignedLecturers/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please enter Subject ID";
        } else {
            $subject = new Subject();
            $subject->setSubjectId($_POST['subjectid']);
            $subject->setLecSubjectIdSession();
        }
    }
}
else
{
    header('location:../pages/Student/Login.php');
}

?>