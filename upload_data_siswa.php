<?php
include "excel_reader.php"; 

$file=$_FILES['userfile']['tmp_name'];

if(empty($file)){
	?><script language="javascript">alert('Tidak ada file yang dipilih');</script><?php
	?><script language="javascript">document.location.href="home.php?page=import_siswa";</script><?php
}else{
	$data = new Spreadsheet_Excel_Reader($file);
	$baris = $data->rowcount($sheet_index=0);
	
	$sukses = 0;
	$gagal = 0;
	
	for ($i=2; $i<=$baris; $i++) //akan membaca data excel mulai dari baris dua. karena baris satu di excel untuk judul field
	{
		$nama = $data->val($i, 2); 
		$nis = $data->val($i, 3); 
		$kelamin = $data->val($i, 4); 
		$alamat = $data->val($i, 5); 
		$telpon = $data->val($i, 6); 
		$username = $data->val($i, 7);
		$password = $data->val($i, 8);
		$photos = $data->val($i, 9); 
		
		if(!empty($nama)){ //cek salah satu inputan
		//user pesan
		insert_user($username,$nama,'siswa');
		
		$query=mysqli_query($link,"insert into data_siswa(nama_siswa,nis,kelamin,alamat_siswa,telpon_siswa,username,password,locked,id_periode,photo) values('$nama','$nis','$kelamin','$alamat','$telpon','$username',md5('$password'),'no','$id_periode','$photos')") or die(mysqli_error());
		
					
		if ($query) $sukses++;
		else $gagal++;
	  	echo mysqli_error();
	  }
	}
	echo "<h3>Proses import data selesai.</h3>";
	echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
	echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
}
?>