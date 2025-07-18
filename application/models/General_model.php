<?php defined('BASEPATH') or exit('No direct script access allowed');

class General_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->Model('general_model');
    }

    public function getOne($table, $where)
    {
        $query = $this->db->get_where($table, $where);
        return $query->row();
    }


    public function getAll($table, $where = '')
    {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return $query->result();
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update($table, $where, $data)
    {
        return $this->db->update($table, $data, $where);
    }
    public function getCount($table, $where = [], $isActive = null)
    {
        if (!is_null($isActive)) {
            $where['isActive'] = $isActive;
        }
    
        if (!empty($where)) {
            $query = $this->db->select()
                ->where($where)
                ->get($table);
        } else {
            $query = $this->db->select()
                ->get($table);
        }
    
        return $query->num_rows();
    }
    public function getData($table, $selectFields = '*', $where = []) {
        $this->db->select($selectFields);
        $this->db->from($table);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();  
    }

  // Count with optional search
public function count_with_search($table, $params = [])
{
    if (isset($params['search'])) {
        $this->db->group_start();
        foreach ($params['search'] as $field => $keyword) {
            $this->db->or_like($field, $keyword);
        }
        $this->db->group_end();
    }
    return $this->db->count_all_results($table);
}

// Fetch with optional search, limit, and offset
public function get_with_search($table, $params = [], $limit = 10, $offset = 0)
{
    if (isset($params['search'])) {
        $this->db->group_start();
        foreach ($params['search'] as $field => $keyword) {
            $this->db->or_like($field, $keyword);
        }
        $this->db->group_end();
    }

    $this->db->limit($limit, $offset);
    $query = $this->db->get($table);
    return $query->result_array();
}

    }