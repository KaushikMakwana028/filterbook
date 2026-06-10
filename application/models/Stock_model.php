<?php
class Stock_model extends CI_Model
{
    private function getOwnerColumn()
    {
        if ($this->db->field_exists('store_id', 'stock')) {
            return 'store_id';
        }

        if ($this->db->field_exists('user_id', 'stock')) {
            return 'user_id';
        }

        return null;
    }

    public function insert_stock($data, $admin_id = null)
    {
        $ownerColumn = $this->getOwnerColumn();

        if ($ownerColumn !== null && $admin_id !== null) {
            $data[$ownerColumn] = $admin_id;
        }

        return $this->db->insert('stock', $data);
    }

    public function get_all_stock($admin_id = null)
    {
        $ownerColumn = $this->getOwnerColumn();

        if ($ownerColumn !== null && $admin_id !== null) {
            $this->db->where($ownerColumn, $admin_id);
        }

        return $this->db->get('stock')->result();
    }

    public function delete_stock($id, $admin_id = null)
    {
        $this->db->where('id', $id);

        $ownerColumn = $this->getOwnerColumn();
        if ($ownerColumn !== null && $admin_id !== null) {
            $this->db->where($ownerColumn, $admin_id);
        }

        return $this->db->delete('stock');
    }
}
