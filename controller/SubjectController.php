<?php
class SubjectController
{
    //Hien thi danh sach sinh vien
    function index()
    {
        $subjectRepository = new SubjectRepository();
        $search = $_GET['search'] ?? '';
        if ($search) {
            $subjects = $subjectRepository->getByPattern($search);
        } else {
            $subjects = $subjectRepository->fetch();
        }
        require 'view/Subject/index.php';
    }

    //Hien thi form sinh vien
    function create()
    {
        require 'view/subject/create.php';
    }

    //Luu sinh vien vao database
    function store()
    {
        $data = $_POST;
        $subjectRepository = new SubjectRepository();
        $name = $_POST['name'];
        if ($subjectRepository->save($data)) {
            // luu thanh cong 
            $_SESSION['success'] = " Đã thêm sinh viên $name thành công";
            header('location: /?c=subject');
            exit;
        }
        $_SESSION['error'] = $subjectRepository->error;
        header('location: /?c=subject');
        exit;
    }

    //ham edit
    function edit()
    {
        // var_dump($_GET);
        $id = $_GET['id'];
        $subjectRepository = new SubjectRepository();
        $subject = $subjectRepository->find($id);
        require 'view/subject/edit.php';
    }

    //ham update
    function update()
    {
        // var_dump($_POST);
        $id = $_POST['id'];
        $name = $_POST['name'];
        $number_of_credit = $_POST['number_of_credit'];

        //Tim Subject trong db
        $subjectRepository = new SubjectRepository();
        $subject = $subjectRepository->find($id);

        // cap nhat doi tuong dua vao du lieu goi len tu form
        $subject->name = $name;
        $subject->number_of_credit = $number_of_credit;

        // luu object xuong db
        if ($subjectRepository->update($subject)) {
            //luu thanh cong
            $_SESSION['success'] = " Đã cập nhật $name thành công";
            header('location: /?c=subject');
            exit;
        }
        // luu that bai 
        $_SESSION['error'] = $subjectRepository->error;
        header('location: /');
        exit;
    }

    //Xoa sinh vien
    function destroy()
    {
        $id = $_GET['id'];
        $subjectRepository = new SubjectRepository();
        $subject = $subjectRepository->find($id);
        $name = $subject->name;

        // Kiem tra mon hoc da duoc sinh vien dang ky chua?
        $regsiterRepository = new RegisterRepository();
        $registers = $regsiterRepository->getBySubjectId($id);
        $num = count($registers);

        if ($num > 0) {
            $_SESSION['error'] = "Mon hoc $name da duoc $num sinh vien dang ky. Khong the xoa";
            header('location: /');
            exit;
        }

        if ($subjectRepository->destroy($id)) {
            // luu thanh cong 
            $_SESSION['success'] = " Đã xóa sinh viên $name thành công";
            header('location: /?c=subject');
            exit;
        }
        // Luu that bai 
        $_SESSION['error'] = $subjectRepository->error;
        header('location: /?c=subject');
        exit;
    }
}
