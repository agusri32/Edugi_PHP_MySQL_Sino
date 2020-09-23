<?php
include "excel_reader.php"; 

$file=$_FILES['userfile']['tmp_name'];



if(empty($file)){
	?><script language="javascript">alert('Tidak ada file yang dipilih');</script><?php
	?><script language="javascript">document.location.href="home.php?page=import_guru";</script><?php
}else{
	$data = new Spreadsheet_Excel_Reader($file);
	$baris = $data->rowcount($sheet_index=0);
	
	$sukses = 0;
	$gagal = 0;
	
	for ($i=2; $i<=$baris; $i++) //akan membaca data excel mulai dari baris dua. karena baris satu di excel untuk judul field
	{
		$nama_guru=$data->val($i, 2); 
		$nip=$data->val($i, 3); 
		$kelamin=$data->val($i, 4); 
		$alamat_guru=$data->val($i, 5); 
		$telpon_guru=$data->val($i, 6); 
		$username=$data->val($i, 7); 
		$password=$data->val($i, 8); 
		
		$gelar=$data->val($i, 9); 
		$tempat_lahir=$data->val($i, 10); 
		$tanggal_lahir=$data->val($i, 11); 
		$agama=$data->val($i, 12); 
		$email=$data->val($i, 13); 
		$photos = $data->val($i, 14);		

		if(!empty($nama_guru)){ //cek salah satu inputan
		//user pesan
		insert_user($username,$nama_guru,'guru');
		
		$query=mysqli_query($link,"insert into data_guru(nama_guru,nip,kelamin,alamat_guru,telpon_guru,username,password,locked,gelar,tempat_lahir,tanggal_lahir,agama,email,photo) values('$nama_guru','$nip','$kelamin','$alamat_guru','$telpon_guru','$username',md5('$password'),'no','$gelar','$tempat_lahir','$tanggal_lahir','$agama','$email','$photos')");
					
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
 