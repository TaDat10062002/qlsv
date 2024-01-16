<?php
class RegisterController
{
    //Hien thi danh sach sinh vien
    function index()
    {
        $registerRepository = new RegisterRepository();
        $search = $_GET['search'] ?? '';
        if ($search) {
            $registers = $registerRepository->getByPattern($search);
        } else {
            $registers = $registerRepository->fetch();
        }
        require 'view/register/index.php';
    }

    //Hien thi form sinh vien
    function create()
    {
        //lay danh sach sinh vien
        $studentRepository = new StudentRepository();
        $students = $studentRepository->fetch();

        //lay danh sach mon hoc 
        $subjectRepository = new SubjectRepository();
        $subjects = $subjectRepository->fetch();
        require 'view/register/create.php';
    }

    //Luu sinh vien vao database
    function store()
    {
        $data = $_POST;
        $registerRepository = new RegisterRepository();

        $student_id = $_POST['student_id'];
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($student_id);
        $student_name = $student->name;

        $subject_id = $_POST['subject_id'];
        $subjectRepository = new SubjectRepository();
        $subject = $subjectRepository->find($subject_id);
        $subject_name = $subject->name;

        if ($registerRepository->save($data)) {
            // luu thanh cong 
            $_SESSION['success'] = "Sinh viên $student_name đăng ký môn $subject_name thành công";
            header('location: /?c=register');
            exit;
        }
        $_SESSION['error'] = $registerRepository->error;
        header('location: /?c=register');
        exit;
    }

    //ham edit
    function edit()
    {
        // var_dump($_GET);
        $id = $_GET['id'];
        $registerRepository = new RegisterRepository();
        $register = $registerRepository->find($id);
        require 'view/register/edit.php';
    }

    //ham update
    function update()
    {
        // var_dump($_POST);
        $id = $_POST['id'];
        $score = $_POST['score'];

        //Tim Register trong db
        $registerRepository = new RegisterRepository();
        $register = $registerRepository->find($id);

        // cap nhat doi tuong dua vao du lieu goi len tu form
        $register->score = $score;
        $student_name = $register->student_name;
        $subject_name = $register->subject_name;

        // luu object xuong db
        if ($registerRepository->update($register)) {
            //luu thanh cong
            $_SESSION['success'] = " Đã cập nhật $student_name thi môn  $subject_name được $score điểm";
            header('location: /?c=register');
            exit;
        }
        // luu that bai 
        $_SESSION['error'] = $registerRepository->error;
        header('location: /?c=register');
        exit;
    }

    //Xoa sinh vien
    function destroy()
    {
        $id = $_GET['id'];
        $registerRepository = new RegisterRepository();
        $register = $registerRepository->find($id);
        $student_id = $register->student_id;
        if ($registerRepository->destroy($id)) {
            // luu thanh cong 
            $_SESSION['success'] = " Đã xóa sinh viên $student_id thành công";
            header('location: /?c=Register');
            exit;
        }
        // Luu that bai 
        $_SESSION['error'] = $registerRepository->error;
        header('location: /?c=Register');
        exit;
    }
}
