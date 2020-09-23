<?php
include "excel_reader.php"; 

$file=$_FILES['userfile']['tmp_name'];

if(empty($file)){
	?><script language="javascript">alert('Tidak ada file yang dipilih');</script><?php
	?><script language="javascript">document.location.href="home.php?page=import_ortu";</script><?php
}else{
	$data = new Spreadsheet_Excel_Reader($file);
	$baris = $data->rowcount($sheet_index=0);
	
	$sukses = 0;
	$gagal = 0;
	
	for ($i=2; $i<=$baris; $i++) //akan membaca data excel mulai dari baris dua. karena baris satu di excel untuk judul field
	{
		$nama_orangtua=$data->val($i, 2);
		$kelamin=$data->val($i, 3);
		$status_keluarga=$data->val($i, 4);
		$pekerjaan=$data->val($i, 5);
		$alamat_orangtua=$data->val($i, 6);
		$telpon_orangtua=$data->val($i, 7);
		$username=$data->val($i, 8);
		$password=$data->val($i, 9);
		$photos = $data->val($i, 10);
		
		if(!empty($nama_orangtua)){ //cek salah satu inputan
		//user pesan
		insert_user($username,$nama_orangtua,'orangtua');
		
		$query=mysqli_query($link,"insert into data_orangtua(nama_orangtua,kelamin,status_keluarga,pekerjaan,alamat_orangtua,telpon_orangtua,username,password,photo)  values('$nama_orangtua','$kelamin','$status_keluarga','$pekerjaan','$alamat_orangtua','$telpon_orangtua','$username',md5('$password'),'$photos')");
					
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
 