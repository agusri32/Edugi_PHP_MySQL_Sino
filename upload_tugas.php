<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Upload Tugas </h1>
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
    
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
	<tr>
		<th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
		<th width="20%" class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
		<th width="20%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Guru</a></th>
		<th width="20%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Kelas</a></th>
		<th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Aksi</a></th>
	</tr>
	
	
	<?php
	$id_kelas=$_SESSION['id_kelas'];
	$id_siswa=$_SESSION['id_siswa'];
	
	$view=mysqli_query($link,"SELECT * FROM setup_matapelajaran matapelajaran, data_guru guru, tbl_jadwal_mengajar jadwal, setup_kelas kelas WHERE jadwal.id_guru=guru.id_guru and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_kelas=kelas.id_kelas and jadwal.id_periode='$id_periode' and jadwal.id_kelas='$id_kelas' order by matapelajaran.nama_matapelajaran asc");			
	$i = 0;
	while($row=mysqli_fetch_array($view)){
		$id_guru=$row['id_guru'];
		$id_kelas=$row['id_kelas'];
		$id_matapelajaran=$row['id_matapelajaran'];
	?>
	<tr>
		<td><?php echo $i=$i+1;?></td>
		<td><?php echo $row['nama_matapelajaran'];?></td>
		<td><?php echo $row['nama_guru'];?></td>
		<td><?php echo $row['nama_kelas'];?></td>
		<td><a href="?page=upload_tugas_siswa&id_siswa=<?php echo $id_siswa;?>&id_guru=<?php echo $id_guru;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>" title="Klik untuk mengupload tugas"><b><font color="#0066FF">Upload Tugas</font></b></a></td>
	</tr>
	<?php
	}
	?>
	</table>
	
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

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