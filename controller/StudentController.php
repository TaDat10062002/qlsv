<?php
class StudentController
{
    //Hien thi danh sach sinh vien
    function index()
    {
        $studentRepository = new StudentRepository();
        $search = $_GET['search'] ?? '';
        if ($search) {
            $students = $studentRepository->getByPattern($search);
        } else {
            $students = $studentRepository->fetch();
        }
        require 'view/student/index.php';
    }

    //Hien thi form sinh vien
    function create()
    {
        require 'view/student/create.php';
    }

    //Luu sinh vien vao database
    function store()
    {
        $data = $_POST;
        $studentRepository = new StudentRepository();
        $name = $_POST['name'];
        if ($studentRepository->save($data)) {
            // luu thanh cong 
            $_SESSION['success'] = " Đã thêm sinh viên $name thành công";
            header('location: /');
            exit;
        }
        $_SESSION['error'] = $studentRepository->error;
        header('location: /');
        exit;
    }

    //ham edit
    function edit()
    {
        // var_dump($_GET);
        $id = $_GET['id'];
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($id);
        require 'view/student/edit.php';
    }

    //ham update
    function update()
    {
        // var_dump($_POST);
        $id = $_POST['id'];
        $name = $_POST['name'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];

        //Tim student trong db
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($id);

        // cap nhat doi tuong dua vao du lieu goi len tu form
        $student->name = $name;
        $student->birthday = $birthday;
        $student->gender = $gender;

        // luu object xuong db
        if ($studentRepository->update($student)) {
            //luu thanh cong
            $_SESSION['success'] = " Đã sửa sinh viên $name thành công";
            header('location: /');
            exit;
        }
        // luu that bai 
        $_SESSION['error'] = $studentRepository->error;
        header('location: /');
        exit;
    }

    //Xoa sinh vien
    function destroy()
    {
        $id = $_GET['id'];
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($id);
        $name = $student->name;

        // Kiem tra sinh vien da dang ky mon hoc hay chua
        $regsiterRepository = new RegisterRepository();
        $registers = $regsiterRepository->getByStudentId($id);
        $num = count($registers);
        
        if($num > 0){
            $_SESSION['error'] = "Sinh vien $name da dang ky $num mon hoc. Khong the xoa";
            header('location: /');
            exit;
        }
        
        if ($studentRepository->destroy($id)) {
            // luu thanh cong 
            $_SESSION['success'] = " Đã xóa sinh viên $name thành công";
            header('location: /');
            exit;
        }
        // Luu that bai 
        $_SESSION['error'] = $studentRepository->error;
        header('location: /');
        exit;
    }
}