<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if (isset($_POST['submit'])){
	$id_matapelajaran=$_POST['id_matapelajaran'];
	$id_guru=$_POST['id_guru'];
	$id_siswa=$_POST['id_siswa'];
	
	$keterangan=ucwords($_POST['keterangan']);
	$nama_file=$_FILES['datafile']['name'];
	$ukuran=$_FILES['datafile']['size'];
	$rnd=date(His);
	
	//anti backdor file .php
	$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
	
	//periksa jika data yang dimasukan belum lengkap
	if ($keterangan=="" || $nama_file=="" || $ext=="php")
	{
		
		?><script language="javascript">document.location.href="?page=upload_tugas_siswa&id_siswa=<?php echo $id_siswa;?>&id_guru=<?php echo $id_guru;?>&id_kelas=<?php echo $id_kelas;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>&status=0";</script><?php
	}else{
		$nama_file_upload=$rnd.'-'.$nama_file;
		//definisikan variabel file dan alamat file
		$uploaddir='./files_tugas/';
		$alamatfile=$uploaddir.$nama_file_upload;

		//periksa jika proses upload berjalan sukses
		if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile))
		{
			//catat data file yang berhasil di upload
			$upload=mysqli_query($link,"INSERT INTO tbl_upload_tugas(id_matapelajaran,id_guru,id_siswa,nama_file,ukuran,url,tgl_upload,keterangan) VALUES('$id_matapelajaran','$id_guru','$id_siswa','$nama_file_upload','$ukuran','$alamatfile','$waktu','$keterangan')");
			
			if($upload){
				?><script language="javascript">document.location.href="?page=upload_tugas_siswa&id_siswa=<?php echo $id_siswa;?>&id_guru=<?php echo $id_guru;?>&id_kelas=<?php echo $id_kelas;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>&status=6";</script><?php
			}else{
				?><script language="javascript">document.location.href="?page=upload_tugas_siswa&id_siswa=<?php echo $id_siswa;?>&id_guru=<?php echo $id_guru;?>&id_kelas=<?php echo $id_kelas;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>&status=0";</script><?php
			}
			
		}else{
			//jika gagal
			echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
		}
	}
}
?>


<!--  start page-heading -->
<div id="page-heading">
    <h1>Upload Tugas</h1>
</div>
<!-- end page-heading -->

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
    <th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
    <th class="topleft"></th>
    <td id="tbl-border-top">&nbsp;</td>
    <th class="topright"></th>
    <th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
    <td id="tbl-border-left"></td>
    <td>
    <!--  start content-table-inner ...................................................................... START -->
    <div id="content-table-inner">
    		
	<?php
	include "warning.php";
	?>
    
	<form enctype="multipart/form-data" action="?page=upload_tugas_siswa" method="post">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	  <td><!--  start step-holder -->
		<!--  end step-holder -->
		  <!-- start id-form -->
		  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
			<tr>
			  <th valign="top">Nama Guru </th>
			  <td>
			  		<?php 
					$id_siswa=$_GET['id_siswa'];
					$id_guru=$_GET['id_guru'];
					$id_matapelajaran=$_GET['id_matapelajaran'];
					?>
					
					<?php
					$guru=mysqli_fetch_array(mysqli_query($link,"select * from data_guru where id_guru='$id_guru'"));
					echo $nama_guru=$guru['nama_guru'];
					?>
			  </td>
			  <td></td>
			</tr>
			<tr>
			  <th valign="top">MataPelajaran</th>
			  <td>
			  		<?php 
					$matkul=mysqli_fetch_array(mysqli_query($link,"select * from setup_matapelajaran where id_matapelajaran='$id_matapelajaran'"));
					echo $nama_matapelajaran=$matkul['nama_matapelajaran'];
					?>
			  </td>
			  <td></td>
			</tr>
			
			<tr>
			  <th valign="top">File</th>
			  <td><input type="file" name="datafile" size="30" id="datafile" /></td>
			  <td></td>
			</tr>
			
			<tr>
			  <th valign="top">Keterangan</th>
			  <td><textarea name="keterangan" cols="25" rows="5"></textarea></td>
			  <td></td>
			</tr>
			
			<tr>
			  <th><a href="?page=upload_tugas"><font color="#0066FF">Back to main</font></a></th>
			  <td valign="top">
					<input type="hidden" name="id_guru" value="<?php echo $id_guru;?>">
					<input type="hidden" name="id_matapelajaran" value="<?php echo $id_matapelajaran;?>">
					<input type="hidden" name="id_siswa" value="<?php echo $id_siswa;?>">
					<input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="" class="form-submit" />
			  </td>
			  <td></td>
			</tr>
		  </table>
		<!-- end id-form  -->
	  </td>
	  <td><!--  start related-activities -->
	  </td>
	</tr>
	<tr>
	  <td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
	  <td></td>
	</tr>
	</table>
	</form>     

	
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
	<tr>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">MataPelajaran</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Nama Guru </a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Nama File</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Tanggal Upload</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Keterangan</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Download</a></th>
	</tr>
	
	
	<?php
	$view=mysqli_query($link,"select * from tbl_upload_tugas upload, data_guru guru, setup_matapelajaran matkul where upload.id_guru=guru.id_guru and upload.id_matapelajaran=matkul.id_matapelajaran and upload.id_siswa='$id_siswa' and upload.id_matapelajaran='$id_matapelajaran' and upload.id_guru='$id_guru' order by tgl_upload asc");
	
	$no=0;
	while($row=mysqli_fetch_array($view)){
	?>	
	<tr>
		<td><?php echo $no=$no+1;?></td>
		<td><?php echo $row['nama_matapelajaran'];?></td>
		<td><?php echo $row['nama_guru'];?></td>
		<td><?php echo $row['nama_file'];?></td>
		<td><?php echo $row['tgl_upload'];?></td>
		<td><?php echo $row['keterangan'];?></td>
		<td><a href="<?php echo $row['url'];?>" target="_blank" title="Ukuran File : <?php echo formatBytes($row['ukuran'],0);?>"><img src="images/logo-download.png" width="80" height="23"></a></td>
	</tr>
	<?php
	}
	?>
	</table>

	<div class="clear"></div>
     
    </div>
    <!--  end content-table-inner ............................................END  -->
    </td>
    <td id="tbl-border-right"></td>
</tr>
<tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
</tr>
</table>