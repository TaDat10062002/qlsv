<?php
// ket noi database de goi nhan du lieu 
class StudentRepository
{
    public $error;
    // tra ve danh sach student tu database 
    function fetch($cond = null)
    {
        global $conn;
        $sql = "SELECT * FROM student";
        if ($cond) {
            $sql .= " WHERE $cond";
        }
        $result = $conn->query($sql);
        $students = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $birthday = $row['birthday'];
                $gender = $row['gender'];
                $student = new Student($id, $name, $birthday, $gender);
                // Them 1 phan tu sinh vien vao cuoi danh sach
                $students[] = $student;
            }
        }
        return $students;
    }

    // luu sinh vien xuong db
    function save($data)
    {
        global $conn;
        $name = $data['name'];
        $birthday = $data['birthday'];
        $gender = $data['gender'];
        $sql = "INSERT INTO student (name, birthday, gender) VALUES ('$name', '$birthday', '$gender')";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" . $conn->error;
        return false;
    }

    //Tim student tuong ung voi id trong database
    function find($id)
    {
        $cond = "id=$id";
        $students = $this->fetch($cond);
        // $student = $students[0];
        $student = current($students); //lay thang hien tai
        return $student;
    }

    function update($student)
    {
        global $conn;
        $name = $student->name;
        $birthday = $student->birthday;
        $gender = $student->gender;
        $id = $student->id;
        $sql = "UPDATE student SET name='$name', birthday='$birthday', gender='$gender'
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
        $sql = "DELETE FROM student WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" . $conn->error;
        return false;
    }

    function getByPattern($search)
    {
        $cond = "name LIKE '%$search%'";
        $students = $this->fetch($cond);
        return $students;
    }
}