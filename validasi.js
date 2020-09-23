function cek_kelas(){
	var nama_kelas=document.getElementById('nama_kelas').value;
	
	if(nama_kelas==''){
		alert('Nama kelas kosong!');
		return false;
	} 
	
	return true;
}

function cek_ruang_kelas(){
	var nama_ruang_kelas=document.getElementById('nama_ruang_kelas').value;
	
	if(nama_ruang_kelas==''){
		alert('Nama Ruang Kelas kosong!');
		return false;
	} 
	
	return true;
}


function cek_matapelajaran(){
	var nama_matapelajaran=document.getElementById('nama_matapelajaran').value;
	
	if(nama_matapelajaran==''){
		alert('Nama matapelajaran kosong!');
		return false;
	} 
	
	return true;
}


function cek_periode(){
	
	var tahun_ajaran=document.getElementById('tahun_ajaran').value;
	
	if(tahun_ajaran==''){
		alert('Tahun ajaran kosong!');
		return false;
	}
	
	return true;
}

/////////////////////////////////////////////////////////////////////

function cek_guru(){
	var nama_guru=document.getElementById('nama_guru').value;
	var nip=document.getElementById('nip').value;
	var alamat_guru=document.getElementById('alamat_guru').value;
	var telpon_guru=document.getElementById('telpon_guru').value;
	var username=document.getElementById('username').value;
	var password=document.getElementById('password').value;
	
	if(nama_guru==''){
		alert('Nama guru kosong!');
		return false;
	}
	
	if(nip==''){
		alert('NIP guru kosong!');
		return false;
	}
	
	if(alamat_guru==''){
		alert('Alamat guru kosong!');
		return false;
	}
	
	if(telpon_guru==''){
		alert('Telpon guru kosong!');
		return false;
	}
	
	if(username==''){
		alert('Username guru kosong!');
		return false;
	}
	
	/*
	if(password==''){
		alert('Password guru kosong!');
		return false;
	}
	*/
	
	return true;
}


function cek_siswa(){
	
	var nama_siswa=document.getElementById('nama_siswa').value;
	var npm=document.getElementById('npm').value;
	var alamat_siswa=document.getElementById('alamat_siswa').value;
	var telpon_siswa=document.getElementById('telpon_siswa').value;
	var username=document.getElementById('username').value;
	var password=document.getElementById('password').value;
	
	if(nama_siswa==''){
		alert('Nama siswa kosong!');
		return false;
	}
	
	if(npm==''){
		alert('NPM siswa kosong!');
		return false;
	}
	
	if(alamat_siswa==''){
		alert('Alamat siswa kosong!');
		return false;
	}
	
	if(telpon_siswa==''){
		alert('Telpon siswa kosong!');
		return false;
	}
	
	if(username==''){
		alert('Username siswa kosong!');
		return false;
	}
	
	/*
	if(password==''){
		alert('Password guru kosong!');
		return false;
	}
	*/

	
	return true;
	
}

function cek_admin(){
	
	var nama_admin=document.getElementById('nama_admin').value;
	var username=document.getElementById('username').value;
	var password=document.getElementById('password').value;
	
	if(nama_admin==''){
		alert('Nama admin kosong!');
		return false;
	}
	
	if(username==''){
		alert('Username admin kosong!');
		return false;
	}
	
	if(password==''){
		alert('Password admin kosong!');
		return false;
	}
		
	return true;
	
}

function cek_ortu(){
	
	var nama_orangtua=document.getElementById('nama_orangtua').value;
	var alamat_orangtua=document.getElementById('alamat_orangtua').value;
	var telpon_orangtua=document.getElementById('telpon_orangtua').value;
	var username=document.getElementById('username').value;
	var password=document.getElementById('password').value;
	
	if(nama_orangtua==''){
		alert('Nama Orang Tua kosong!');
		return false;
	}
		
	if(alamat_orangtua==''){
		alert('Alamat Orang Tua kosong!');
		return false;
	}
	
	if(telpon_orangtua==''){
		alert('Telpon Orang Tua kosong!');
		return false;
	}
	
	if(username==''){
		alert('Username Orang Tua kosong!');
		return false;
	}
	
	/*
	if(password==''){
		alert('Password guru kosong!');
		return false;
	}
	*/

	
	return true;
	
}


//////////////////////////////////////////////////////////////////////////////


function cek_pengumuman(){
	
	var judul=document.getElementById('judul').value;
	var isi=document.getElementById('isi').value;
	
	if(judul==''){
		alert('Judul masih kosong!');
		return false;
	}
	
	if(isi==''){
		alert('Isi Pengumuman kosong!');
		return false;
	}
			
}
