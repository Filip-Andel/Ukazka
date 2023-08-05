<?php

class user_repository extends abstraktni{

    public function GetUser()
    {
        $sql = 'SELECT * from user order by name';
        return $this->db->selectAll($sql);
    }

    public function GetStudents()
    {
        $sql = 'SELECT * from user where teacher=0 order by name';
        return $this->db->selectAll($sql);
    }

    public function GetStudentsByTeacherId($teacher_id)
    {
        $sql = 'SELECT * from user where teacher_id=:teacher_id order by name';

        $params = [
            ':teacher_id' => $teacher_id,
        ];

        return $this->db->selectAll($sql, $params);
    }

    public function GetTeachers()
    {
        $sql = 'SELECT * from user where teacher=1 order by name';
        return $this->db->selectAll($sql);
    }

    public function RegistrUser($name, $surname, $email, $passwd, $teacher_id)
    {
        $sql ='INSERT INTO user SET name=:name, surname=:surname, email=:email, password = SHA2(:password, 256), teacher_id=:teacher_id';

        $params = [
            ':name' => $name,
            ':surname' => $surname,
            ':email' => $email,
            ':password' => $passwd,
            ':teacher_id' => $teacher_id,
        ];

        return $this->db->insertID($sql, $params);
    }

    public function UpdateGDPR($id)
    {
        $sql ='UPDATE user SET gdpr=1 where id=:id';

        $params = [
            ':id' => $id,
        ];

        return $this->db->update($sql, $params);
    }

    public function RegistrTeacher($name, $surname, $email, $passwd)
    {
        $sql ='INSERT INTO user SET name=:name, surname=:surname, email=:email, password = SHA2(:password, 256), teacher=1';

        $params = [
            ':name' => $name,
            ':surname' => $surname,
            ':email' => $email,
            ':password' => $passwd,
        ];

        return $this->db->insertID($sql, $params);
    }

    public function getUserByLogin($email, $password)
    {
        $sql='SELECT * FROM user where email=:email and password=SHA2(:password,256)';

        $params = [
            ':email' => $email,
            ':password' => $password,
        ];

        return $this->db->selectOne($sql, $params);
    }

    public function getUserById($id)
    {
        $sql ='SELECT * from user where id = :id';

        $params = [
            ':id' => $id,
        ];

        return $this->db->selectOne($sql, $params);
    }

    public function deleteUser($id)
    {
        $sql ='DELETE from user where id = :id';

        $params = [
            ':id' => $id,
        ];

        return $this->db->delete($sql, $params);
    }
}