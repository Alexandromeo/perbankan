<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('register_model');
		$this->model = $this->register_model;
		return true;
	}

/*	private function kirimEmail()
	{
		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "alexandromeo@makinrajin.com";
		$config['smtp_pass'] = "hambaAllah625";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		$ci->email->initialize($config);
		$ci->email->from("alexandromeo@makinrajin.com");
		$list = array('alexandromeo123@gmail.com');
		$ci->email->to($list);
		$ci->email->subject('judul');
		$ci->email->message('isi');
		if ($this->email->send())
			return true;
		else
			return false;
	}*/

	public function index()
	{
		if (isset($_POST['register']))
		{
			$email = $this->input->post('email');
			$pass = $this->input->post('password');
			$ulang = $this->input->post('ulang');

			if (!empty($email) && !empty($pass) && !empty($ulang))
			{
				if ($this->validasi->validasiEmail($email))
				{
					if ($pass==$ulang)
					{
						if ($this->validasi->validasiLength($pass,6))
						{
							if ($this->validasi->validasiPassword($pass))
							{
								$pass = $this->validasi->hasy($pass);
								$data = array
										(
											'email'=>$email,
											'password'=>$pass
										);
								$q = $this->model->cekEmail("user", array('email'=>$email));

								if ($q<=0)
								{
									$this->session->set_userdata(array('email'=>$email));
									$register = $this->model->daftarEmail("user", $data);
									redirect(base_url('member'));
								}
								else
									redirect(base_url('register?m='.base64_encode("Email telah terdaftar sebelumnya")));
							}

							else
								redirect(base_url('register?m='.base64_encode("Password harus mengandung minimal huruf dan angka")));	
						}

						else
							redirect(base_url('register?m='.base64_encode("Password minimal 6 karakter")));	
					}

					else
						redirect(base_url('register?m='.base64_encode("Password berbeda dengan ulang password")));	
				}

				else
					redirect(base_url('register?m='.base64_encode("Email tidak valid")));

			}

			else
				redirect(base_url('register?m='.base64_encode("Seluruh data harus diisi")));

		}

		else
			$this->load->view('v_register');
	}
}
