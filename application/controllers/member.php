<?php

class member extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->email = $this->session->userdata('email');
		if (empty($this->email))
			redirect(base_url('login'));
		$this->load->model('member_model');
		$this->model = $this->member_model;
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date("d M Y");
		$this->tanggal = $tanggal;
		$jam = date("H:i");
		$this->jam = $jam;
		return true;
	}

	public function index()
	{
		$get['person'] = $this->model->cekProfile("user", array('email'=>$this->email));
		$get['rekening'] = $this->model->cekProfile("rekening", array('pemilik'=>$this->email));
		$this->load->vars($get);
		$this->load->view('member/v_index');
	}

	public function profile()
	{
		if (isset($_POST['ubahprofile']))
			$this->ubahprofile();
		else if (isset($_POST['ubahktp']))
			$this->ubahfoto("ktp");
		else if(isset($_POST['ubahkk']))
			$this->ubahfoto("kk");
		else if(isset($_POST['ubahpassword']))
			$this->ubahpassword($this->input->post('password_lama'), $this->input->post('password_baru'), $this->input->post('ulang_password'));

		$get['rekening'] = $this->model->cekProfile("rekening", array('pemilik'=>$this->email));
		$get['person'] = $this->model->cekProfile("user", array('email'=>$this->email));
		$this->load->vars($get);
		$this->load->view('member/v_profile');
	}

	private function ubahprofile()
	{
		$email = $this->email;
		$nama = ucwords($this->input->post('nama'));
		$alamat = ucwords($this->input->post('alamat'));

		$data = array
				(
					'nama_lengkap'=>$nama,
					'alamat'=>$alamat
				);

		if (!empty($nama) && !empty($alamat))
		{
			if ($this->validasi->validasiNama($nama))
			{
				$update = $this->model->ubahData("user", $data, "email", $email);
				if ($update)
					redirect(base_url('member/profile?s='.base64_encode("Berhasil mengubah profil")));
				else
					redirect(base_url('member/profile?m='.base64_encode("Gagal Mengubah Profil. Terjadi kesalahan")));
			}

			else
				redirect(base_url('member/profile?m='.base64_encode("Nama hanya boleh huruf dan spasi")));
		}

		else
			redirect(base_url('member/profile?m='.base64_encode("Seluruh data harus diisi")));	
	}

	private function ubahfoto($nama)
	{
		$foto = $_FILES[$nama];
		$namafoto = $foto['name'];
		$tmpfoto = $foto['tmp_name'];
		$sizefoto = $foto['size'];
		$valid = array("jpg","jpeg","png","gif");
		$tmp = $foto['tmp_name'];

		$config['upload_path']  = realpath(APPPATH.'../assets/image/'.$nama.'/');
		$this->load->library('upload', $config);

		list($txt, $ext) = explode(".", $namafoto);

		if (!empty($namafoto))
		{
			if (in_array(strtolower($ext), $valid))
			{
				if ($sizefoto<1000000) //max 1 mb
				{
					$namafoto = $this->email.".jpg";
					$data = array($nama=>$namafoto);
					if (move_uploaded_file($tmp, $config['upload_path']."/".$namafoto))
					{
						$datafoto = array('email'=> $this->email);
						$dbfoto = $this->model->cekProfile('user', $datafoto);
						if ($dbfoto[$nama] != "")
							$this->model->hapusFoto($nama, $dbfoto[$nama]);

						$ch = $this->model->ubahData("user",$data,"email",$this->email);
						if ($ch)
							redirect(base_url('member/profile?s='.base64_encode("Berhasil Upload Foto ".strtoupper($nama))));
						else
							redirect(base_url('member/profile?m='.base64_encode("Gagal Upload Foto! Terjadi Kesalahan")));
					}

					else
						redirect(base_url('member/profile?m='.base64_encode("Terjadi Kesalahan! Gagal Upload Foto")));
				}

				else
					redirect(base_url('member/profile?m='.base64_encode("Ukuran foto maksimal 1 MB")));
			}	

			else
				redirect(base_url('member/profile?m='.base64_encode("Ekstensi foto harus JPG, JPEG, PNG, GIF")));	
		}

		else
			redirect(base_url('member/profile?m='.base64_encode("Data harus diisi")));	
	}

	private function ubahpassword($old, $new, $re)
	{
		if (!empty($old) && !empty($new) && !empty($re))
		{
			if ($new==$re)
			{
				if ($this->validasi->validasiLength($new, 6))
				{
					if ($this->validasi->validasiPassword($new))
					{
						$new = $this->validasi->hasy($new);
						$check = $this->model->cekProfile("user", array('email'=>$this->email));
						if ($this->validasi->verify($old, $check['password']))
						{
							$update = $this->model->ubahData("user", array('password'=>$new), "email", $this->email);
							if ($update)
								redirect(base_url('member/profile?s='.base64_encode("Berhasil mengubah password")));	
							else
								redirect(base_url('member/profile?m='.base64_encode("Gagal mengubah password. Terjadi kesalahan")));	
						}
						else
							redirect(base_url('member/profile?m='.base64_encode("Password tidak sesuai dengan database")));	
					}

					else
						redirect(base_url('member/profile?m='.base64_encode("Password harus mengandung minimal huruf dan angka")));	
				}

				else
					redirect(base_url('member/profile?m='.base64_encode("Password minimal 6 karakter")));	
			}

			else
				redirect(base_url('member/profile?m='.base64_encode("Password harus sama dengan ulang password")));	
		}

		else
			redirect(base_url('member/profile?m='.base64_encode("Seluruh data harus diisi")));	
	}

	public function rekening()
	{
		$get['person'] = $this->model->cekProfile("user", array('email'=>$this->email));
		foreach ($get['person'] as $person=>$val)
		{
			if (empty($val))
				redirect(base_url('member'));
		}

		if (isset($_POST['buatrekening']))
			$this->buatRekening();

		if ($this->model->cekProfile('rekening', array('pemilik'=>$this->email))>0)
		{
			$get['rekening'] = $this->model->cekProfile('rekening', array('pemilik'=>$this->email));
			$view = 'v_datarek';
		}
		else
			$view = 'v_rekening';

		$this->load->vars($get);
		$this->load->view('member/'.$view);
	}

	public function detail()
	{
		$get['person'] = $this->model->cekProfile('user', array('email'=>$this->email));
		$get['rekening'] = $this->model->cekProfile('rekening', array('pemilik'=>$this->email));

		if (isset($_POST['aksirekening']))
		{
			if($this->aksiRekening())
			{
				$get['aksi'] = $this->aksi;

				if ($get['aksi']=="kirim")
					$get['penerima'] = $this->penerima;

				$get['pengirim'] = $this->pengirim;
				$get['nominal'] = $this->nominal;
				$get['infopenerima'] = $this->infopenerima;
				$this->load->vars($get);
				$this->load->view('member/v_detail');
			}
		}

		else if (isset($_POST['transfer']))
		{
			if ($this->aksiatm())
			{
				$get['sender'] = $this->pengirim;
				$get['amount'] = $this->nominal;
				$get['receiver'] = $this->penerima;
				$get['info'] = $this->infopenerima;
				$this->load->vars($get);
				$this->load->view('member/v_detailatm');
			}
		}

		else if(isset($_POST['tarikatm']))
		{
			$rek = $this->model->cekProfile("rekening", array('pemilik'=>$this->email));
			$nominal = $this->input->post('nominal');
			$pin = $this->input->post('pin');

			if (!is_null($nominal) && !is_null($pin))
			{
				if ($rek['jenis']=="Regular")
					$minim = 20000;
				else
					$minim = 200000;

				if ($rek['saldo']-$nominal>=$minim)
				{
					if ($this->validasi->verify($pin, $rek['pin']))
					{
						$dec = $this->model->ubahData("rekening", array('saldo'=>$rek['saldo']-$nominal), "pemilik",$this->email);

						$data = array
								(
									'rekening'=>$rek['no_rek'],
									'nominal'=>$nominal,
									'alamat'=>'-',
									'atm'=>1,
									'approval'=>1,
									'tanggal'=>$this->tanggal,
									'jam'=>$this->jam
								);
						$log = $this->model->tambahData("penarikan", $data);
						if ($dec && $data)
							redirect(base_url('member/atm?s='.base64_encode("Berhasil menarik uang")));
						else
							redirect(base_url('member/atm?m='.base64_encode("Gagal menarik uang. Terjadi kesalahan")));
					}

					else
						redirect(base_url('member/atm?m='.base64_encode("PIN tidak sesuai")));
				}

				else
					redirect(base_url('member/atm?m='.base64_encode("Saldo tidak mencukupi")));
			}

			else
				redirect(base_url('member/atm?m='.base64_encode("Seluruh data harus diisi")));
		}

		else if (isset($_POST['fixkirim']))
		{
			$saldo = $this->input->post('saldo');
			$asal = $this->input->post('asal');
			$tujuan = $this->input->post('tujuan');
			$tanggal = $this->tanggal;
			$jam = $this->jam;
			$nominal = $this->input->post('nominal');
			$data = array
					(
						'asal'=>$asal,
						'tujuan'=>$tujuan,
						'atm'=>0,
						'approval'=>0,
						'tanggal'=>$tanggal,
						'jam'=>$jam,
						'nominal'=>$nominal
					);

			$ajukan = $this->model->tambahData("pengiriman", $data);
			$berkurang = $this->model->ubahData("rekening", array('saldo'=>$saldo-$nominal), "no_rek", $asal);

			if ($berkurang)
				redirect(base_url('member/?s='.base64_encode("Permohonan mengirim uang ke rekening ".$tujuan." sudah terkirim. Admin akan mengecek terlebih dahulu")));
		}

		else if(isset($_POST['trf']))
		{
			$saldo = $this->input->post('saldo');
			$saldopenerima = $this->input->post('saldopenerima');
			$asal = $this->input->post('asal');
			$tujuan = $this->input->post('tujuan');
			$tanggal = $this->tanggal;
			$jam = $this->jam;
			$nominal = $this->input->post('nominal');

			$data = array
					(
						'asal'=>$asal,
						'tujuan'=>$tujuan,
						'atm'=>1,
						'approval'=>1,
						'tanggal'=>$tanggal,
						'jam'=>$jam,
						'nominal'=>$nominal
					);

			$ajukan = $this->model->tambahData("pengiriman", $data);
			$berkurang = $this->model->ubahData("rekening", array('saldo'=>$saldo-$nominal), "no_rek", $asal);
			$tambah = $this->model->ubahData("rekening", array('saldo'=>$saldopenerima+$nominal), "no_rek", $tujuan);
			if ($berkurang && $tambah)
				redirect(base_url('member/?s='.base64_encode("Berhasil transfer. Anda bisa cek bukti transfernya")));
		}

		else
			redirect(base_url('member'));
	}

	private function buatRekening()
	{
		$jenis = $this->input->post('jenis');
		$saldo = (int)$this->input->post('saldo');
		if ($jenis!="Regular")
			$pin = "000000";
		else
			$pin = $this->input->post('pin');

		$rek = rand(111111111,999999999);
		$tanggal = $this->tanggal;
		$jam = $this->jam;
		$pemilik = $this->email;
		
		if ($jenis!="" && $saldo != "")
		{
				if ($jenis=="Regular")
					$minimum = 50000;
				else
					$minimum = 250000;

				if ($saldo>=$minimum)
				{
					if (is_numeric($pin))
					{
						if (strlen($pin)==6)
						{
							$check = $this->model->cekProfile("rekening", array('no_rek'=>$rek));
							$validEmail = $this->model->cekProfile("rekening", array('pemilik'=>$this->email));
							if ($validEmail>0)
								redirect(base_url('member/?m='.base64_encode("Email telah memiliki rekening")));

							else
							{
								while($check>0)
									$rek = rand(111111111,999999999);

								$data = array
											(
												'jenis'=>$jenis,
												'saldo'=>$saldo,
												'no_rek'=>$rek,
												'tanggal_buat'=>$tanggal,
												'jam_buat'=>$jam,
												'pemilik'=>$pemilik,
												'pin'=>$this->validasi->hasy($pin)
											);

								$this->model->tambahData("rekening", $data);
								redirect(base_url('member/?s='.base64_encode("Berhasil membuat rekening")));
							}
						}

						else
							redirect(base_url('member/rekening?m='.base64_encode("PIN harus 6 digit")));
					}

					else
						redirect(base_url('member/rekening?m='.base64_encode("PIN harus hanya berupa angka")));
				}

				else
					redirect(base_url('member/rekening?m='.base64_encode("Minimal pengisian pertama adalah ".$minimum)));	
			}

			else
				redirect(base_url('member/rekening?m='.base64_encode("Seluruh data harus diisi")));	
	}

	private function aksiRekening()
	{
		$pengirim = $this->model->cekProfile("rekening", array('pemilik'=>$this->email));

		$aksi = $this->input->post('aksi');
		$nominal = $this->input->post('nominal');
		$tujuan = $this->input->post('alamat');

		if (!empty($aksi) && !empty($nominal))
		{
			if (is_numeric($nominal))
			{
				if ($aksi=="tarik" || $aksi=="kirim")
				{
					if (!empty($tujuan))
					{
						if ($nominal<$pengirim['saldo'])
						{
							if ($pengirim['jenis']=="Regular")
								$minim = 20000;
							else
								$minim = 200000;

							if ($pengirim['saldo']-$nominal>=$minim)
							{
								if ($aksi=="kirim")
								{
									if ($tujuan!=$pengirim['no_rek'])
									{
										$penerima = $this->model->cekProfile("rekening", array('no_rek'=>$tujuan));
										$infopenerima = $this->model->cekProfile("user", array('email'=>$penerima['pemilik']));

										if ($penerima<=0)
											redirect(base_url('member/rekening?m='.base64_encode('Gagal transfer uang. Nomor rekening tidak terdaftar')));

										$this->aksi = $aksi;
										$this->nominal = $nominal;
										$this->pengirim = $pengirim;
										$this->penerima = $penerima;
										$this->infopenerima = $infopenerima;
										return true;
									}

									else
										redirect(base_url('member/rekening?m='.base64_encode('Anda tidak bisa mengirim ke rekening sendiri')));
								}

								else if($aksi=="tarik")
								{
									$berkurang = $this->model->ubahData("rekening", array('saldo'=>$pengirim['saldo']-$nominal), "no_rek", $pengirim['no_rek']);

									$data = array
											(
												'rekening'=>$pengirim['no_rek'],
												'nominal'=>$nominal,
												'alamat'=>$tujuan,
												'approval'=>0,
												'tanggal'=>$this->tanggal,
												'jam'=>$this->jam
											);
									$insertLog = $this->model->tambahData("penarikan", $data);
									if(!$berkurang && !$insertLog)
										redirect(base_url('member/rekening?m='.base64_encode('Gagal menarik uang. Terjadi kesalahan')));
									else
										redirect(base_url('member/rekening?s='.base64_encode('Permintaan menarik uang sudah terkirim. Kami akan memproses terlebih dahulu')));
									return false;
								}
							}

							else
								redirect(base_url('member/rekening?m='.base64_encode('Batas minimal uang pada rekening Anda minimal '.$minim)));
						}

						else
							redirect(base_url('member/rekening?m='.base64_encode('Nominal melebihi saldo')));
					}

					else
						redirect(base_url('member/rekening?m='.base64_encode('Tujuan tidak boleh kosong')));
				}

				else if($aksi=="tambah")
				{

					 $data = array
					 		(
					 			'no_rek'=>$pengirim['no_rek'],
					 			'nominal'=>$nominal,
					 			'approval'=>0,
					 			'tanggal'=>$this->tanggal,
					 			'jam'=>$this->jam
					 		);
					 $insertLog = $this->model->tambahData("topup",$data);

					 if ($insertLog)
					 	redirect(base_url('member/rekening?s='.base64_encode('Berhasil melakukan permintaan mengisi saldo. Selanjutnya akan admin cek terlebih dahulu')));
					 else
					 	redirect(base_url('member/rekening?m='.base64_encode('Gagal mengisi saldo')));
				}
			}

			else
				redirect(base_url('member/rekening?m='.base64_encode('Nominal harus berupa angka')));
		}

		else
			redirect(base_url('member/rekening?m='.base64_encode('Seluruh data harus diisi')));
	}

	public function atm()
	{
		$get['person'] = $this->model->cekProfile("user", array('email'=>$this->email));
		$get['rekening'] = $this->model->cekProfile("rekening", array('pemilik'=>$this->email));
		$this->load->vars($get);
		$this->load->view('member/v_atm');
	}

	private function aksiatm()
	{
		$pengirim = $this->model->cekProfile("rekening", array('pemilik'=>$this->email));

		$nominal = $this->input->post('nominal');
		$tujuan = $this->input->post('tujuan');

		$penerima = $this->model->cekProfile("rekening", array('no_rek'=> $tujuan));
		$infopenerima = $this->model->cekProfile("user", array('email'=> $penerima['pemilik']));
		$inputpin = $this->input->post('pin');
		$pin = $this->validasi->verify($inputpin, $pengirim['pin']);

		if (!empty($nominal) && !empty($tujuan) && !empty($inputpin))
		{
			if ($penerima>0)
			{
				if (is_numeric($nominal))
				{
					if ($pengirim['saldo']-$nominal>=20000)
					{
						if ($pin)
						{
							$this->pengirim = $pengirim;
							$this->nominal = $nominal;
							$this->penerima = $penerima;
							$this->infopenerima = $infopenerima;
							return true;
						}

						else
							redirect(base_url('member/atm?s='.base64_encode("Gagal transfer. PIN salah")));
					}

					else
						redirect(base_url('member/atm?s='.base64_encode("Gagal transfer. Saldo tidak mencukupi")));
				}

				else
					redirect(base_url('member/atm?s='.base64_encode("Gagal transfer. Nominal harus berupa angka")));
			}

			else
				redirect(base_url('member/atm?s='.base64_encode("Gagal transfer. Nomor Rekening ".$tujuan." tidak terdaftar")));
		}

		else
			redirect(base_url('member/atm?s='.base64_encode("Seluruh data harus diisi")));
	}

	public function histori()
	{
		$uri = $this->uri->segment(3);
		$get['person'] = $this->model->cekProfile("user", array('email'=>$this->email));
		$get['rekening'] = $this->model->cekProfile("rekening", array('pemilik'=>$this->email));
		
		if ($uri=="login")
		{
			$get['login'] = $this->model->cekData("login", array('email'=>$this->email), "id", "desc");
			$path = 'v_historilogin';
		}
		else if($uri=="penarikan")
		{
			$get['penarikan'] = $this->model->cekData("penarikan", array('rekening'=>$get['rekening']['no_rek']), "id", "desc");
			$path = 'v_historipenarikan';
		}
		else if($uri=="pengisian")
		{
			$get['topup'] = $this->model->cekData('topup', array('no_rek'=>$get['rekening']['no_rek']), "id", 'desc');
			$path = 'v_historipengisian';
		}
		else if($uri=="transfer")
		{
			$get['transfer'] = $this->model->cekData('pengiriman', array('asal'=>$get['rekening']['no_rek']),'id','desc');
			$path = 'v_historitransfer';
		}
		else
			$path = 'v_index';

		$this->load->vars($get);
		$this->load->view('member/'.$path);

	}
}