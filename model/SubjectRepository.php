<?php
// ket noi database de goi nhan du lieu 
class SubjectRepository
{
    public $error;
    // tra ve danh sach subject tu database 
    function fetch($cond = null)
    {
        global $conn;
        $sql = "SELECT * FROM subject";
        if ($cond) {
            $sql .= " WHERE $cond";
        }
        $result = $conn->query($sql);
        $subjects = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $number_of_credit = $row['number_of_credit'];
                $subject = new subject($id, $name, $number_of_credit);
                // Them 1 phan tu mon hoc vao cuoi danh sach
                $subjects[] = $subject;
            }
        }
        return $subjects;
    }

    // luu subject xuong db
    function save($data)
    {
        global $conn;
        $name = $data['name'];
        $number_of_credit = $data['number_of_credit'];
        $sql = "INSERT INTO subject (name, number_of_credit) VALUES ('$name', '$number_of_credit')";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" . $conn->error;
        return false;
    }

    //Tim subject tuong ung voi id trong database
    function find($id)
    {
        $cond = "id=$id";
        $subjects = $this->fetch($cond);
        // $subject = $subjects[0];
        $subject = current($subjects); //lay thang hien tai
        return $subject;
    }

    function update($subject)
    {
        global $conn;
        $name = $subject->name;
        $number_of_credit = $subject->number_of_credit;
        $id = $subject->id;
        $sql = "UPDATE subject SET name='$name', number_of_credit=$number_of_credit
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
        $sql = "DELETE FROM subject WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" . $conn->error;
        return false;
    }

    function getByPattern($search)
    {
        $cond = "name LIKE '%$search%'";
        $subjects = $this->fetch($cond);
        return $subjects;
    }
}
