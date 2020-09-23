<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if(isset($_POST['submit'])){
	
   $id_guru 	     = $_POST['id_guru'];
   $id_kelas 	     = $_POST['id_kelas']; 
   $id_matapelajaran = $_POST['id_matapelajaran'];
   $judul_tugas      = $_POST['judul_tugas'];
   $deskripsi_tugas  = $_POST['deskripsi_tugas'];

   $query = "insert into tbl_pengumuman_tugas values('','$id_guru','$id_kelas','$id_matapelajaran','$judul_tugas','$deskripsi_tugas','$id_periode','$waktu')";
   $hasil=mysqli_query($link,$query);
	
	if($hasil){
		?><script language="javascript">document.location.href="?page=pengumuman_tugas_input&status=1&id_guru=<?php echo $id_guru;?>&id_kelas=<?php echo $id_kelas;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=pengumuman_tugas_input&status=0";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}
?>


<!--  start page-heading -->
<div id="page-heading">
    <h1>Pengumuman Tugas</h1>
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
    	
		<?php include "warning.php"?>

      	<!--  start product-table ..................................................................................... -->
        
    	<?php		
		$id_guru=$_GET['id_guru'];
		$id_kelas=$_GET['id_kelas'];
		$id_matapelajaran=$_GET['id_matapelajaran'];
		
		$guru=mysqli_fetch_array(mysqli_query($link,"select * from data_guru where id_guru='$id_guru'"));
		$kelas=mysqli_fetch_array(mysqli_query($link,"select * from setup_kelas where id_kelas='$id_kelas'"));
		$matapelajaran=mysqli_fetch_array(mysqli_query($link,"select * from setup_matapelajaran where id_matapelajaran='$id_matapelajaran'"));
		
		$nama_guru=$guru['nama_guru'];
		$nama_kelas=$kelas['nama_kelas'];
		$nama_matapelajaran=$matapelajaran['nama_matapelajaran'];
		?>
    
    
        <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="id-form">
		 <tr>
          <th valign="top">Nama Guru</th>
          <td><?php echo ucwords($nama_guru);?></td>
          <td></td>
        </tr>
		 <tr>
          <th valign="top">Nama Kelas</th>
          <td><?php echo $nama_kelas;?></td>
          <td></td>
        </tr>
         <tr>
          <th valign="top">Mata Pelajaran</th>
          <td><?php echo $nama_matapelajaran;?></td>
          <td></td>
        </tr>
      </table>
      <br />
      
        <form id="mainform" action="home.php?page=pengumuman_tugas_input" method="post">
			<input type="hidden" name="id_guru" value="<?php echo $id_guru;?>" />
			<input type="hidden" name="id_matapelajaran" value="<?php echo $id_matapelajaran;?>" />	
			<input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>" />
			
			<table id="id-form">
			<tr>
				<th>Judul Tugas</th><td><input class="inp-form" type="text" name="judul_tugas"></td>
			</tr>
			<tr>
				<th>Deskripsi Tugas</th><td><textarea cols="25" rows="5" name="deskripsi_tugas"></textarea></td>
			</tr>
			<tr>
				<td><a href="?page=pengumuman_tugas"><b><font color="#0099FF">Kembali</font></b></a></td><td><input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" class="form-submit" ></td>
			</tr>
			</table>
			
        </form>
        
        <p><i><font color="#FF0000">*Dalam deskripsi cantumkan tanggal pengumpulan tugas</font></i>
</p>
        <p>&nbsp;		  </p>
        <form id="mainform" action="" method="post">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="6%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th width="12%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Kelas</a></th>
            <th width="14%" class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
            <th width="19%" class="table-header-repeat line-left minwidth-1"><a href="">Judul Tugas</a></th>
			<th width="33%" class="table-header-repeat line-left minwidth-1"><a href="">Deskripsi Tugas</a></th>
			<th width="16%" class="table-header-repeat line-left minwidth-1"><a href="">Waktu Submit</a></th>
        </tr>
        
        <?php
		$view=mysqli_query($link,"SELECT * FROM tbl_pengumuman_tugas tugas, setup_kelas kelas, setup_matapelajaran matapelajaran where tugas.id_kelas=kelas.id_kelas and tugas.id_matapelajaran=matapelajaran.id_matapelajaran and tugas.id_matapelajaran='$id_matapelajaran' and tugas.id_guru='$id_guru' and tugas.id_periode='$id_periode' order by id_tugas_kelas asc");
		
		$i = 1;
		while($row=mysqli_fetch_array($view)){
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['nama_kelas'];?></td>
				<td><?php echo $row['nama_matapelajaran'];?></td>
				<td><?php echo $row['judul_tugas'];?></td>
				<td><?php echo $row['deskripsi_tugas'];?></td>
				<td><?php echo $row['waktu_submit'];?></td>
			</tr>
			<?php
		}
		?>
        </table>
        <!--  end product-table................................... --> 
        </form>
		
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