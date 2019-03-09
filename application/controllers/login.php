<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller 
{
	public function __construct()
	{
		date_default_timezone_set("Asia/Jakarta");
		parent::__construct();
		$this->load->model('register_model');
		$this->model = $this->register_model;
		return true;
	}

	public function admin()
	{
		if (isset($_POST['loginadmin']))
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			if (!empty($email) && !empty($password))
			{
				$admin = $this->model->cekEmail('admin', array('email'=>$email));
				if ($admin>0)
				{
					if ($this->validasi->verify($password, $admin['password']))
					{
						$this->session->set_userdata(array('email'=>$email));
						redirect(base_url('admin'));
					}

					else
						redirect(base_url('login/admin?m='.base64_encode("Password tidak sesuai")));
				}

				else
					redirect(base_url('login/admin?m='.base64_encode("Email tidak terdaftar")));
			}

			else
				redirect(base_url('login/admin?m='.base64_encode("Seluruh data harus diisi")));
		}

		else
			$this->load->view('v_loginadmin');
	}

	public function index()
	{
		if (isset($_POST['login']))
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if (!empty($email) && !empty($password))
			{
				$check = $this->model->cekEmail("user", array('email'=>$email));
				if ($check>0)
				{
					if ($this->validasi->verify($password, $check['password']))
					{
						$log = array
								(
									'tanggal'=>date("d M Y"),
									'jam'=>date("H:i"),
									'email'=>$email
								);
						$this->model->daftarEmail('login', $log);
						$this->session->set_userdata(array('email'=>$email));
						redirect(base_url('member'));
					}

					else
						redirect(base_url('login?m='.base64_encode("Password tidak sesuai")));
				}

				else
					redirect(base_url('login?m='.base64_encode("Email belum terdaftar")));
			}

			else
				redirect(base_url('login?m='.base64_encode("Seluruh data harus diisi")));
		}

		else
			$this->load->view('v_login');
	}
}
