<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Catalog_model extends CI_Model
{

    public function getAll($admin_id = null)
    {
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }

        return $this->db->get('catalog')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('catalog', $data);
    }
public function getPaginated($admin_id, $search = '', $limit = 10, $offset = 0)
{
    // Build query
    $this->db->where('admin_id', $admin_id);
    
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like('name', $search);
        $this->db->or_like('description', $search);
        $this->db->or_like('price', $search);
        $this->db->group_end();
    }
    
    // Get total count
    $total = $this->db->count_all_results('catalog', FALSE);
    
    // Get paginated data
    $this->db->limit($limit, $offset);
    $this->db->order_by('id', 'DESC');
    $products = $this->db->get()->result();
    
    return [
        'products' => $products,
        'total' => $total,
        'per_page' => $limit,
        'current_page' => floor($offset / $limit) + 1,
        'total_pages' => ceil($total / $limit)
    ];
}
    public function getById($id)
    {
        return $this->db->get_where('catalog', ['id' => $id])->row();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('catalog', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('catalog', ['id' => $id]);
    }
}