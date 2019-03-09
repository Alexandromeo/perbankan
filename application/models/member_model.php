<?php

class member_model extends CI_Model
{
	public function cekProfile($table, $email)
	{
		return $this->db
					->get_where($table, $email)
					->row_array();
	}

	public function cekData($table, $email, $param, $asc)
	{
		return $this->db
					->order_by($param, $asc)
					->get_where($table, $email)
					->result();
	}

	public function ubahData($table, $set, $key, $value)
	{
		return $this->db->where($key, $value)
						->update($table, $set);
	}

	public function hapusFoto($folder, $file)
	{
		return unlink('.assets/image/'.$folder.'/'.$file);
	}

	public function tambahData($table, $data)
	{
		return $this->db->insert($table, $data);
	}
}