<?php

defined('BASEPATH') or exit("No Direct Script Allowed");

class UserModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all($filters = [], $sort = 'id', $order = 'ASC')
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

        return $this->db->get('employee')->result();
    }

    public function insert_user($data)
    {
        return $this->db->insert('employee', $data);
    }

    public function update_user($id, $data)
    {
        return $this->db->update('employee', $data, ['id' => $id]);
    }

    public function delete_user($id)
    {
        return $this->db->delete('employee', ['id' => $id]);
    }

    public function get_id($id)
    {
        return $this->db->get('employee', ['id' => $id])->row_array();
    }

    public function update_profile($id, $filename)
    {
        $this->db->where('id', $id);
        return $this->db->update('employee', ['profile' => $filename]);
    }

}

?>