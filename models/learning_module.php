<?php

//session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/SipsewanaEDU/config.php";

$conn = new Conn();
$con = $conn->getConn();

if(isset($_SESSION['id']))
{


} else {
    header('location:../pages/Student/Homeworks/Manage/List.php');
}

class Learning_Module {
    protected $lm_id;
    protected $name;
    protected $type='PDF';
    protected $fileName;
    protected $path;
    protected $description;
    protected $date;


    public function getFiles($student_id) {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT lm.lm_id,lm.name,s.subjectname,lm.date,lm.fileName,lm.path FROM student_reg sr, subject s, learning_module lm WHERE sr.st_sub_id = s.subject_id AND s.subject_id = lm.lm_sub_id AND sr.st_reg_id = '".$student_id."'");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
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