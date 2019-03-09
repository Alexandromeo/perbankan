<?php

class validasi
{
	function validasiLength($param, $length)
	{
		if (strlen($param)>=$length)
			return true;
		else
			return false;
	}

	function validasiEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			return true;
		else
			return false;
	}

	function hasy($pass)
	{
		$hashed = password_hash($pass, PASSWORD_DEFAULT);
		return $hashed;
	}

	function verify($input, $db)
	{
		$verif = password_verify($input, $db);
		return $verif;
	}	

	function validasiPassword($pass) //password minimal mengandung huruf dan angka
	{
		//password harus mengandung angka dan huruf (simbol boleh tapi tidak wajib)
		if (!preg_match("/([0-9])/", $pass) || !preg_match("/([a-zA-Z])/", $pass))
			return false;
		else
			return true;
	}

	function validasiNama($param)
	{
		//hanya berupa huruf dan spasi
		if(preg_match("/^[a-z A-Z]+$/", $param))
			return true;
		else
			return false;
	}

	function validasiAlert($url,$stts, $msg)
	{
		if ($stts=="error")
			$stts = 'm';
		else if($stts=="success")
			$stts = 's';

		redirect(base_url($url.'?'.$stts.'='.base64_encode($msg)));
	}
}

