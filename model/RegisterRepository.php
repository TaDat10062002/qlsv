<?php
// ket noi database de goi nhan du lieu 
class RegisterRepository
{
    public $error;
    // tra ve danh sach Register tu database 
    function fetch($cond = null)
    {
        global $conn;
        $sql = "SELECT register.*, student.name AS student_name, subject.name AS subject_name 
        FROM register
        JOIN student ON student.id = register.student_id
        JOIN subject ON subject.id = register.subject_id";
        if ($cond) {
            $sql .= " WHERE $cond";
        }
        $result = $conn->query($sql);
        $registers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $student_id = $row['student_id'];
                $subject_id = $row['subject_id'];
                $student_name = $row['student_name'];
                $subject_name = $row['subject_name'];
                $score = $row['score'];
                $register = new Register($id, $student_id, $subject_id, $score, $student_name, $subject_name);
                // Them 1 phan tu dang ky mon hoc vao cuoi danh sach
                $registers[] = $register;
            }
        }
        return $registers;
    }

    // luu Register xuong db
    function save($data)
    {
        global $conn;
        $student_id = $data['student_id'];
        $subject_id = $data['subject_id'];
        $sql = "INSERT INTO register (student_id, subject_id) VALUES ('$student_id', '$subject_id')";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" . $conn->error;
        return false;
    }

    //Tim Register tuong ung voi id trong database
    function find($id)
    {
        $cond = "register.id=$id";
        $registers = $this->fetch($cond);
        // $Register = $Registers[0];
        $register = current($registers); //lay thang hien tai
        return $register;
    }

    function update($register)
    {
        global $conn;
        $score = $register->score;
        $id = $register->id;
        $sql = "UPDATE register SET score = $score 
                WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" . $conn->error;
        return false;
    }

    function destroy($id)
    {
        global $conn;
        $sql = "DELETE FROM register WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" . $conn->error;
        return false;
    }

    public function getByPattern($search)
    {
        $cond = "student.name LIKE '%$search%' OR subject.name LIKE '%$search%'";
        $registers = $this->fetch($cond);
        return $registers;
    }

    // lay danh sach dang ky mon hoc cua 1 inh vien cu the 
    public function getByStudentId($student_id)
    {
        $cond = "student_id LIKE '%$student_id%'";
        $registers = $this->fetch($cond);
        return $registers;
    }

    public function getBySubjectId($subject_id)
    {
        $cond = "subject_id LIKE '%$subject_id%'";
        $registers = $this->fetch($cond);
        return $registers;
    }
}