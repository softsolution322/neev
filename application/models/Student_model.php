<?php

class Student_model extends CI_Model {

    public function add_student_photo($student_id, $photo_path) {
        $data = array(
            'student_id' => $student_id,
            'photo_path' => $photo_path
        );
        return $this->db->insert('student_photos', $data);
    }

    public function get_student_photos($student_id) {
        return $this->db->where('student_id', $student_id)
                        ->order_by('uploaded_at', 'DESC')
                        ->get('student_photos')
                        ->result();
    }

    public function get_photo_by_id($photo_id) {
        return $this->db->where('id', $photo_id)
                        ->get('student_photos')
                        ->row();
    }

    public function delete_photo($photo_id) {
        return $this->db->where('id', $photo_id)
                        ->delete('student_photos');
    }
} 