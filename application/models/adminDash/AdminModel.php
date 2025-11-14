<?php

defined('BASEPATH') or exit("No Direct Script Allowed");

class AdminModel extends CI_Model{

    public function __construct() {
        $this->load->database();
    }

    public function get_users($filters = [], $sort = 'id', $order = 'ASC')
    {
        // Sanitize inputs
        $allowed_sort_columns = ['id', 'name', 'email', 'role', 'created_at'];
        if (!in_array($sort, $allowed_sort_columns)) {
            $sort = 'id';
        }

        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';

        // Apply filters
        if (!empty(trim($filters['name'] ?? ''))) {
            $this->db->like('name', trim($filters['name']));
        }
        if (!empty(trim($filters['email'] ?? ''))) {
            $this->db->like('email', trim($filters['email']));
        }
        if (!empty(trim($filters['role'] ?? ''))) {
            $this->db->where('role', trim($filters['role']));
        }

        // Apply sorting
        $this->db->order_by($sort, $order);

        return $this->db->get('tbl_admin')->result();
    }

    public function create_user($data){
        $this->db->insert('tbl_admin',$data);
        return $this->db->insert_id();
    }

    public function update_user($id,$data){
      return  $this->db->update('tbl_admin',$data,['id'=>$id]);
    }

    public function delete_user($id){
        return $this->db->delete('tbl_admin',['id'=>$id]);
    }

    public function get_user_by_email($email){
        return $this->db->get_where('tbl_admin',['email'=>$email])->row_array();
    }

    public function count_users(){
        return $this->db->count_all('tbl_admin');
    }
}

?>