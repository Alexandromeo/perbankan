<?php

class admin_model extends CI_Model
{
	public function cekData($table, $pk)
	{
		return $this->db
					->get_where($table, $pk)
					->row_array();
	}

	public function ubahData($table, $set, $key, $value)
	{
		return $this->db->where($key, $value)
						->update($table, $set);
	}

	public function hapusFoto($path)
	{
		return unlink(".assets/image/profile/admin/".$path);
	}
}