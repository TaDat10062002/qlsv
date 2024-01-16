<!-- file index trong mo hiinh mvc dong vai tro lam router  -->

<?php
session_start();
//router
// http://qlsvmvc.com/?c=subject&a=create
// di den controller subject va thuc thi function create 

// import config va connectDb
require 'config.php';
require 'connectDb.php';

// c la controller, a la action (ham trong controller)
// http://qlsvmvc.com, mặc định c là student, a là index 
$c = $_GET['c'] ?? 'student';
$a = $_GET['a'] ?? 'index';

// ucfirst() là chữ hoa ký tự đầu tiên 
$strController = ucfirst($c) . 'Controller'; //StudentController 

// import model 
require 'model/StudentRepository.php';
require 'model/Student.php';

require 'model/SubjectRepository.php';
require 'model/Subject.php';

require 'model/RegisterRepository.php';
require 'model/Register.php';

// import file chứa class controller tương ứng 
require "controller/$strController.php";

//Cuối cùng là muốn gọi hàm của controller tương ứng 
$controller = new $strController(); //new StudentController()
$controller->$a();//$controller->index();