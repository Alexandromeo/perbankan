<?php

class admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->model = $this->admin_model;
		if (empty($this->session->userdata('email')))
			redirect(base_url());

		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date("d M Y");
		$this->tanggal = $tanggal;
		$jam = date("H:i");
		$this->jam = $jam;
		$this->email = $this->session->userdata('email');
		return true;
	}

	public function index()
	{
		$get['person'] = $this->model->cekData("admin", array('email'=>$this->email));
		$this->load->vars($get);
		$this->load->view('admin/v_index');
	}


	private function prosesupdate($data = array())
	{
		$this->model->ubahData('admin', $data, 'email', $this->email);
	}

	public function profile()
	{
		$path = __CLASS__."/".__FUNCTION__;
		if (isset($_POST['ubahprofile']))
		{
			$nama = $this->input->post('nama');
			$tempat_lahir = $this->input->post('tempat_lahir');
			$thn = $this->input->post('tahun_lahir');
			$bln = $this->input->post('bulan_lahir');
			$tgl = $this->input->post('tanggal_lahir');
			$tanggal_lahir = $tgl." ".$bln." ".$thn;

			if (!empty($nama) && !empty($tempat_lahir) && !empty($thn) && !empty($bln) && !empty($tgl))
			{
				if ($this->validasi->validasiNama($nama) && $this->validasi->validasiNama($tempat_lahir))
				{
					$data = array
							(
								'nama'=>$nama,
								'tempat_lahir'=>$tempat_lahir,
								'tanggal_lahir'=>$tanggal_lahir
							);

					$this->prosesupdate($data);
					$this->validasi->validasiAlert($path,'success','Berhasil mengubah profil');
				}

				else
					$this->validasi->validasiAlert($path,'error','Nama dan tempat lahir hanya boleh mengandung huruf dan spasi');
			}

			else
				$this->validasi->validasiAlert($path,'error','Seluruh data harus diisi');
		}

		else if(isset($_POST['ubahpassword']))
		{
			$old = $this->input->post('old');
			$new = $this->input->post('new');
			$re = $this->input->post('re');

			if (!empty($old) && !empty($new) && !empty($re))
			{
				if ($new==$re)
				{
					if ($this->validasi->validasiPassword($new))
					{
						if ($this->validasi->validasiLength($new, 6))
						{
							$check = $this->model->cekData(__CLASS__, array('email'=>$this->email));
							if ($this->validasi->verify($old, $check['password']))
							{
								$new = $this->validasi->hasy($new);
								$this->prosesupdate(array('password'=>$new));
								$this->validasi->validasiAlert($path, 'success', 'Berhasil mengubah password');
							}

							else
								$this->validasi->validasiAlert($path, 'error', 'Password lama tidak sesuai');
						}

						else
							$this->validasi->validasiAlert($path, 'error', 'Password minimal 6 karakter');
					}

					else
						$this->validasi->validasiAlert($path, 'error', 'Password harus mengandung minimal huruf dan angka');
				}

				else
					$this->validasi->validasiAlert($path, 'error', 'Password baru dan ulang password tidak sama');
			}

			else
				$this->validasi->validasiAlert($path, 'error', 'Seluruh data harus diisi');
		}

		else if(isset($_POST['ubahfoto']))
		{
			$foto = $_FILES['foto'];
			$namafoto = $foto['name'];
			$tmpfoto = $foto['tmp_name'];
			$sizefoto = $foto['size'];
			$valid = array("jpg","jpeg","png","gif");
			$tmp = $foto['tmp_name'];

			$config['upload_path']  = realpath(APPPATH.'../assets/image/'.__CLASS__);

			$this->load->library('upload', $config);

			if ($namafoto != "")
			{
				//memisahkan variabel berdasarkan titik
				list($txt, $ext) = explode(".", $namafoto);

				if (in_array(strtolower($ext), $valid))
				{
					if ($sizefoto<1000000) //max 1 mb
					{
						$namafoto = $this->email.".jpg";
						$data = array('foto'=>$namafoto);
						if (move_uploaded_file($tmp, $config['upload_path']."/".$namafoto))
						{
							$datafoto = array('email'=> $this->email);
							$dbfoto = $this->model->cekData('admin', $datafoto);

							if ($dbfoto['foto'] != "")
								$this->model->hapusFoto($dbfoto['foto']);

							$this->prosesupdate($data);
							$this->validasi->validasiAlert($path, 'success', 'Berhasil mengupload foto');
						}

						else
							$this->validasi->validasiAlert($path, 'error', 'Terjadi kesalahan');
					}

					else
						$this->validasi->validasiAlert($path, 'error', 'Ukuran foto maksimal 1 MB');
				}

				else
					$this->validasi->validasiAlert($path, 'error', 'Ekstensi foto yang diperbolehkan adalah JPG, JPEG, PNG, GIF');
			}

			else
				$this->validasi->validasiAlert($path, 'error', 'Seluruh data harus diisi');
		}

		else
		{
			$get['person'] = $this->model->cekData("admin", array('email'=>$this->email));
			$this->load->vars($get);
			$this->load->view('admin/v_profile');
		}
	}
}