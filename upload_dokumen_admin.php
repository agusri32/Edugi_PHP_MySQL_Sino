<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}

if (isset($_POST['submit'])){
	$keterangan=ucwords($_POST['keterangan']);
	$nama_file=$_FILES['datafile']['name'];
	$ukuran=$_FILES['datafile']['size'];
	$tipe=$_FILES['datafile']['type'];
	$rnd=date(His);
	
	$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
	
	//$ext = end(explode(".", $nama_file));
	//$path = pathinfo($nama_file);
	//$ext = $path['extension'];
	
	//periksa jika data yang dimasukan belum lengkap
	if ($keterangan=="" || $nama_file=="" || $ext=="php")
	{
		?><script language="javascript">document.location.href="?page=upload_dokumen_admin&status=0";</script><?php
	}else{
		$nama_file_upload=$rnd.'-'.$nama_file;
		//definisikan variabel file dan alamat file
		$uploaddir='./files_dokumen/';
		$alamatfile=$uploaddir.$nama_file_upload;

		//periksa jika proses upload berjalan sukses
		if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile))
		{
			//catat data file yang berhasil di upload
			$upload=mysqli_query($link,"INSERT INTO tbl_upload_dokumen(nama_file,ukuran,url,tgl_upload,keterangan) VALUES('$nama_file_upload','$ukuran','$alamatfile','$waktu','$keterangan')");
			
			if($upload){
				?><script language="javascript">document.location.href="?page=upload_dokumen_admin&status=6";</script><?php
			}else{
				?><script language="javascript">document.location.href="?page=upload_dokumen_admin&status=0";</script><?php
			}
			
		}else{
			//jika gagal
			echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
		}
	}
}

if($_GET['mode']=='delete'){

	$id_dokumen=$_GET['id_dokumen'];
	$nama_file="./files_dokumen/".$_GET['nama_file'];
	
	unlink($nama_file);
	$query=mysqli_query($link,"delete from tbl_upload_dokumen where id_dokumen='$id_dokumen'");
	if($query){
		?><script language="javascript">document.location.href="?page=upload_dokumen_admin&status=2";</script><?php
	}
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Upload Dokumen </h1>
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
    
	<form enctype="multipart/form-data" action="?page=upload_dokumen_admin" method="post">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	  <td><!--  start step-holder -->
		<!--  end step-holder -->
		  <!-- start id-form -->
		  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
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
		<th class="table-header-repeat line-left minwidth-1"><a href="">Nama File</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Ukuran File</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Tanggal Upload</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Keterangan</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Download</a></th>
		<th class="table-header-options line-left"><a href="">Aksi</a></th>
	</tr>
	
	
	<?php
	$view=mysqli_query($link,"select * from tbl_upload_dokumen");
	
	$no=0;
	while($row=mysqli_fetch_array($view)){
	?>	
	<tr>
		<td><?php echo $no=$no+1;?></td>
		<td><?php echo $row['nama_file'];?></td>
		<td><?php echo formatBytes($row['ukuran'],0);?></td>
		<td><?php echo $row['tgl_upload'];?></td>
		<td><?php echo $row['keterangan'];?></td>
		<td><a href="<?php echo $row['url'];?>" target="_blank"><img src="images/logo-download.png" width="80" height="23"></a></td>
		<td class="options-width">
		<a href="?page=upload_dokumen_admin&mode=delete&id_dokumen=<?php echo $row['id_dokumen'];?>&nama_file=<?php echo $row['nama_file']; ?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>            
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