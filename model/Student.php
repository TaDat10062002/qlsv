<?php
// khuong banh co ten la student
class Student
{
    //khai bao thuoc tinh 
    public $id;
    public $name;
    public $birthday;
    public $gender;

    function __construct($id, $name, $birthday, $gender)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->gender = $gender;
    }

    function getAge()
    {
        $currentYear = date('Y'); //2023
        $temp = explode('-', $this->birthday);
        $bornYear = $temp[0];
        $age = $currentYear - $bornYear;
        return $age;
    }
}