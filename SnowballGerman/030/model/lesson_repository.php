<?php

class lesson_repository extends abstraktni{

    public function getLessonsByUserId($id)
    {
        $sql ='SELECT *, DATE_FORMAT(date,"%e/%c/%y") as date_form from lesson where user_id = :id ORDER BY `date` DESC';

        $params = [
            ':id' => $id,
        ];

        return $this->db->selectAll($sql, $params);
    }

    public function getTopTenLessonsByUserId($id)
    {
        $sql ='SELECT *, DATE_FORMAT(date,"%e/%c/%y") as date_form from lesson where user_id = :id ORDER BY `date` DESC limit 6';

        $params = [
            ':id' => $id,
        ];

        return $this->db->selectAll($sql, $params);
    }

    public function getLastLesson($id)
    {
        $sql ='SELECT * from lesson where user_id = :id ORDER BY `date` DESC limit 1';

        $params = [
            ':id' => $id,
        ];

        return $this->db->selectAll($sql, $params);
    }

    public function getLesson($id)
    {
        $sql ='SELECT *, DATE_FORMAT(date,"%e.%c.%Y") as date_form from lesson where id = :id';

        $params = [
            ':id' => $id,
        ];

        return $this->db->selectOne($sql, $params);
    }

    public function getLessonForEachStudent($id)
    {
        $sql ='SELECT *, DATE_FORMAT(date,"%e/%c/%y") as date_form FROM (SELECT * FROM lesson as tb1 WHERE id IN (SELECT MAX(id) FROM lesson as tb2 GROUP BY user_id)) as tb3 where teacher_id=:id order by date DESC';

        $params = [
            ':id' => $id,
        ];

        return $this->db->selectAll($sql, $params);
    } 
    
    public function addLesson($text, $user_id, $hw, $teacher_id)
    {
        $sql = 'INSERT INTO lesson SET date= NOW(), note= :note, user_id=:user_id, hw=:hw, teacher_id=:teacher_id';
        $params = [
            ':note' => $text,
            ':user_id' => $user_id,
            ':hw' => $hw,
            ':teacher_id' => $teacher_id,
        ];

        return $this->db->insert($sql, $params);
    }

    
    public function deleteUsersLessons($id)
    {
        $sql ='DELETE from lesson where user_id = :id';

        $params = [
            ':id' => $id,
        ];

        return $this->db->delete($sql, $params);
    }

    public function updateLesson($id, $note, $hw)
    {
        $sql ='UPDATE lesson set note = :note, hw = :hw where id = :id';

        $params = [
            ':id' => $id,
            ':note' => $note,
            ':hw' => $hw,
        ];

        return $this->db->update($sql, $params);
    }

    public function updateLessonV2($id, $note, $plan, $hw)
    {
        $sql ='UPDATE lesson set heading = :note, plan = :plan, hw=:hw where id = :id';

        $params = [
            ':id' => $id,
            ':note' => $note,
            ':plan' => $plan,
            ':hw' => $hw,
        ];

        return $this->db->update($sql, $params);
    }

    public function deleteLesson($id)
    {
        $sql ='DELETE from lesson where id = :id';

        $params = [
            ':id' => $id,
        ];

        return $this->db->delete($sql, $params);
    }
}
