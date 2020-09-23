<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}

if($kuesioner!=='buka'){
	?><script language="javascript">document.location.href="?page=dashboard"</script><?php
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Kuisioner Penilaian Guru </h1>
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
    
	<table border="0" width="40%" cellpadding="0" cellspacing="0" id="product-table">
	<tr>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Nama Guru</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Aksi</a></th>
	</tr>
	
	
	<?php
	$id_kelas=$_SESSION['id_kelas'];
	$id_siswa=$_SESSION['id_siswa'];
	
	$view=mysqli_query($link,"SELECT distinct nama_guru, guru.id_guru FROM data_guru guru, tbl_jadwal_mengajar jadwal, setup_kelas kelas WHERE jadwal.id_guru=guru.id_guru and jadwal.id_kelas=kelas.id_kelas and jadwal.id_periode='$id_periode' and jadwal.id_kelas='$id_kelas' order by guru.nama_guru asc");			
	$i = 0;
	while($row=mysqli_fetch_array($view)){
		$id_guru=$row['id_guru'];
	?>
	<tr>
		<td><?php echo $i=$i+1;?></td>
		<td><?php echo $row['nama_guru'];?></td>
		<td><a href="?page=kuesioner_isi&id_siswa=<?php echo $id_siswa;?>&id_guru=<?php echo $id_guru;?>" title="Klik untuk mengisi kuesioner"><b><font color="#0066FF">Isi Kuesioner</font></b></a></td>
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