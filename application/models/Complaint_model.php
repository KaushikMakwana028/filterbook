<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint_model extends CI_Model
{
    private $table = 'complaint';

    public function get_all($store_id)
    {
        return $this->db
            ->from($this->table)
            ->where('store_id', $store_id)
            ->order_by('id', 'DESC')
            ->get()
            ->result();
    }

    public function get_by_id($id, $store_id)
    {
        return $this->db
            ->from($this->table)
            ->where('id', $id)
            ->where('store_id', $store_id)
            ->get()
            ->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function mark_done($id, $store_id)
    {
        $this->db->where('id', $id);
        $this->db->where('store_id', $store_id);
        $this->db->update($this->table, [
            'status' => 2
        ]);

        return $this->db->affected_rows() > 0;
    }

    public function update_status($id, $store_id, $status)
    {
        $this->db->where('id', $id);
        $this->db->where('store_id', $store_id);
        $this->db->update($this->table, [
            'status' => (int) $status
        ]);

        return $this->db->affected_rows() > 0;
    }

    public function delete($id, $store_id)
    {
        $this->db->where('id', $id);
        $this->db->where('store_id', $store_id);
        $this->db->delete($this->table);

        return $this->db->affected_rows() > 0;
    }
}
