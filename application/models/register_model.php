<?php

class register_model extends CI_Model
{
	public function cekEmail($table, $email)
	{
			return $this->db
					->get_where($table, $email)
					->row_array();
	}

	public function daftarEmail($table, $data)
	{
		return $this->db
					->insert($table, $data);
	}
}