<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}

if (isset($_POST['submit'])){
	$id_matapelajaran=$_POST['id_matapelajaran'];
	$id_guru=$_POST['id_guru'];
	$keterangan=ucwords($_POST['keterangan']);
	$nama_file=$_FILES['datafile']['name'];
	$ukuran=$_FILES['datafile']['size'];
	$rnd=date(His);
	
	//anti backdor file .php
	$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
	
	//periksa jika data yang dimasukan belum lengkap
	if ($keterangan=="" || $nama_file=="" || $ext=="php")
	{
		?><script language="javascript">document.location.href="?page=upload_materi_guru&status=0";</script><?php
	}else{
		$nama_file_upload=$rnd.'-'.$nama_file;
		//definisikan variabel file dan alamat file
		$uploaddir='./files_materi/';
		$alamatfile=$uploaddir.$nama_file_upload;

		//periksa jika proses upload berjalan sukses
		if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile))
		{
			//catat data file yang berhasil di upload
			$upload=mysqli_query($link,"INSERT INTO tbl_upload_materi(id_matapelajaran,id_guru,nama_file,ukuran,url,tgl_upload,keterangan) VALUES('$id_matapelajaran','$id_guru','$nama_file_upload','$ukuran','$alamatfile','$waktu','$keterangan')");
			
			if($upload){
				?><script language="javascript">document.location.href="?page=upload_materi_guru&status=6";</script><?php
			}else{
				?><script language="javascript">document.location.href="?page=upload_materi_guru&status=0";</script><?php
			}
			
		}else{
			//jika gagal
			echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
		}
	}
}
?>

<?php
if($_GET['mode']=='delete'){

	$id_materi=$_GET['id_materi'];
	$nama_file="./files_materi/".$_GET['nama_file'];
	
	unlink($nama_file);
	$query=mysqli_query($link,"delete from tbl_upload_materi where id_materi='$id_materi'");
	if($query){
		?><script language="javascript">document.location.href="?page=upload_materi_guru&status=2";</script><?php
	}else{
		echo mysqli_error();
	}
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Upload Materi Pelajaran </h1>
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
    
	<form enctype="multipart/form-data" action="?page=upload_materi_guru" method="post">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	  <td><!--  start step-holder -->
		<!--  end step-holder -->
		  <!-- start id-form -->
		  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
			<tr>
			  <th valign="top">Nama Guru </th>
			  <td><?php echo $_SESSION['nama_account'];?></td>
			  <td></td>
			</tr>
			<tr>
			  <th valign="top">MataPelajaran</th>
			  <td><select name="id_matapelajaran" >
				  <?php
				  $id_guru=$_SESSION['id_guru'];
				  $matapelajaran=mysqli_query($link,"select distinct(matapelajaran.nama_matapelajaran),matapelajaran.id_matapelajaran from tbl_jadwal_mengajar jadwal, setup_matapelajaran matapelajaran where jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_guru='$id_guru' order by id_jadwal asc");
				  while($row2=mysqli_fetch_array($matapelajaran)){
				  ?>
					  <option value="<?php echo $row2['id_matapelajaran'];?>"><?php echo $row2['nama_matapelajaran'];?></option>
				  <?php
				  }
				  ?>    
				</select>
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
			  <th>&nbsp;</th>
			  <td valign="top">
					<input type="hidden" name="id_guru" value="<?php echo $id_guru;?>">
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
		<th class="table-header-repeat line-left minwidth-1"><a href="">Pelajaran</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Guru</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Nama File</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Tanggal</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Keterangan</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Download</a></th>
		<th class="table-header-options line-left"><a href="">Aksi</a></th>
	</tr>
	
	
	<?php
	$view=mysqli_query($link,"select * from tbl_upload_materi upload, data_guru guru, setup_matapelajaran matkul where upload.id_guru=guru.id_guru and upload.id_matapelajaran=matkul.id_matapelajaran and upload.id_guru='$id_guru' order by tgl_upload asc");
	
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
		<td class="options-width">
		<a href="?page=upload_materi_guru&mode=delete&id_materi=<?php echo $row['id_materi'];?>&nama_file=<?php echo $row['nama_file']; ?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>            
		</td>
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