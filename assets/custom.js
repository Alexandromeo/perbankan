function checkEmail(email)
{
	var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if (filter.test(email))
		return true;
	else
		return false;
}

function checkSame()
{
	var pass = $(".input-pass").val();
	var ulang = $(".input-ulang").val();
	if (pass==ulang)
	{
		$(this).css("border","2px solid #1abc9c");
		$(".ulang-msg").text("Password sama dengan konfirmasi password").css("color", "#16a085").show();
	}

	else
	{
		$(this).css("border","2px solid #e74c3c");
		$(".ulang-msg").text("Password tidak sama dengan konfirmasi password").css("color", "#e74c3c").show();
	}
}

function checkNull(param)
{
	if (param!="")
		return true;
	else
		return false;
}

function checkLength(param, angka)
{
	if (param.length>=angka)
		return true;
	else
		return false;
}

function checkAlphaNum(param)
{
	var number = /([0-9])/;
	var alpha = /([a-zA-Z])/;
	if (!param.match(number) || !param.match(alpha))
		return false;
	else
		return true;
}

$('.mata').mousedown(function()
{
	$('.mata').removeClass('fa-eye').addClass('fa-eye-slash');
	$('#pass').attr('type','text');
});

$('.mata').mouseup(function()
{
	$('.mata').removeClass('fa-eye-slash').addClass('fa-eye');
	$('#pass').attr('type','password');
});

$('.mata-ulang').mousedown(function()
{
	$('.mata-ulang').removeClass('fa-eye').addClass('fa-eye-slash');
	$('#ulang').attr('type','text');
});

$('.mata-ulang').mouseup(function()
{
	$('.mata-ulang').removeClass('fa-eye-slash').addClass('fa-eye');
	$('#ulang').attr('type','password');
});

var success = false;

$(".input-email").keyup(function()
{
	var email = $(this).val();
	if (checkEmail(email))
	{
		$(".email-msg").html("Email valid<br/>").css("color", "#16a085").show();
		success = true;
	}
	else
	{
		success = false;
		$(".email-msg").html("Email tidak valid<br/>").css("color", "#e74c3c").show();	
	}

	if (!checkLength(email, 1))
	{
		success = false;
		$(".email-msg-2").html("Email tidak boleh kosong<br>").css("color", "#e74c3c").show();
	}

	else
		$(".email-msg-2").hide();

	if (success)
		$(this).css("border","2px solid #1abc9c");
	else
		$(this).css("border","2px solid #e74c3c");

});

$(".input-pass").keyup(function()
{
	var param = $(this).val();

	if (checkAlphaNum(param))
	{
		$(".pass-msg").html("Password telah mengandung minimal angka dan huruf<br>").css("color", "#16a085").show();
		success = true;
	}

	else
	{
		success = false;
		$(".pass-msg").html("Password harus mengandung minimal angka dan huruf<br>").css("color", "#e74c3c").show();		
	}

	if (checkLength(param, 6))
		$(".pass-msg-2").html("Password telah mencapai 6 karakter<br>").css("color", "#16a085").show();

	else
	{
		success = false;
		$(".pass-msg-2").html("Password minimal 6 karakter<br>").css("color", "#e74c3c").show();
	}

	if (success)
		$(this).css("border","2px solid #1abc9c");
	else
		$(this).css("border","2px solid #e74c3c");

});

$('.input-ulang').keyup(function()
{
	var ulang = $(".input-ulang").val();
	if (checkLength(ulang, 1))
		$(this).css("border","2px solid #1abc9c");
	else
		$(this).css("border","2px solid #e74c3c"); //red
	checkSame();
});

$(".input-pass").keyup(function()
{
	checkSame();
});

$("#jenis").change(function()
{
	$(".keterangan-tabungan").empty();
	$("#pengisian").attr('min','0').val('0');
	var jenis = $(this).val();
	if (jenis=="Regular")
	{
		$(".keterangan-tabungan").append("Fitur dan Keterangan Tabungan "+jenis+" :<br/>");
		$(".keterangan-tabungan").append("1. Potongan Rp5.000 setiap bulannya. Apabila saldo telah mencapai minimal selama 2 bulan berturut-turut maka akun akan dihapus<br/>");
		$(".keterangan-tabungan").append("2. Tersedia ATM<br/>");
		$(".keterangan-tabungan").append("3. Bisa mengirim, mengisi, mencairkan uang<br/>");
		$(".keterangan-tabungan").append("4. Minimal saldo Rp20.000 dan pengisian pertama Rp50.000<br/>");
		$("#pengisian").attr('min','50000').val('50000');
		$(".atm").removeClass('hide');
	}

	else if (jenis=="Investasi")
	{
		$(".keterangan-tabungan").append("Fitur dan Keterangan Tabungan "+jenis+" :<br/>");
		$(".keterangan-tabungan").append("1. Tambahan sekitar 5% bunga dari saldo bertambah ke rekening secara berkala<br/>");
		$(".keterangan-tabungan").append("2. Tidak tersedia ATM<br/>");
		$(".keterangan-tabungan").append("3. Tidak bisa mengirim uang<br/>");
		$(".keterangan-tabungan").append("4. Minimal saldo Rp200.000 dan pengisian pertama Rp250.000<br/>");
		$("#pengisian").attr('min','250000').val('250000');
		$(".atm").addClass('hide');
	}			
});

$("#aksi").change(function()
{
	var aksi = $(this).val();
	if (aksi=="tarik")
	{
		$(".info-label").text("Alamat Pengiriman Uang");
		$(".alamat").removeClass("hide");
	}

	else if (aksi=="kirim")
	{
		$(".info-label").text("Rekening Tujuan");
		$(".alamat").removeClass("hide");
	}
	else
		$(".alamat").addClass("hide");
});

function changeDate()
{
	var i;
	var tahun = $('.opsitahun').val();
	var bln = $('.opsibulan').val();

	if (bln==2)
	{
		if (tahun%4==0)
			i = 29;
		else
			i = 28;
	}

	else if (bln==1 || bln==3 || bln==5 || bln==7 || bln==8 || bln==10 || bln==12)
		i = 31;
	else
		i = 30;

	$('.tgl').detach();
	for (var j=1; j<=i; j++)
	{
		$('<option class="'+j+' tgl" value="'+j+'">'+j+'</option>').appendTo('.opsitanggal');
	}
}

$("#thn").change(function()
{
	changeDate();
});

$("#bln").change(function()
{
	changeDate();
});