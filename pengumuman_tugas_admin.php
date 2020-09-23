<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if($_GET['mode']=='delete'){

	$id_tugas_kelas=$_GET['id_tugas_kelas'];
	$query=mysqli_query($link,"delete from tbl_pengumuman_tugas where id_tugas_kelas='$id_tugas_kelas'");
	if($query){
		?><script language="javascript">document.location.href="?page=pengumuman_tugas_admin&status=2";</script><?php
	}
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Pengumuman Tugas</h1>
</div>
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
	<th width="5%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
	<th width="11%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Guru</a></th>
	<th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
	<th width="6%" class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
	<th width="13%" class="table-header-repeat line-left minwidth-1"><a href="">Judul Tugas</a></th>
	<th width="29%" class="table-header-repeat line-left minwidth-1"><a href="">Deskripsi Tugas</a></th>
	<th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">Waktu Submit</a></th>
	<th width="6%" class="table-header-repeat line-left minwidth-1"><a href="">Aksi</a></th>
	</tr>
	
	<?php
	
	$view=mysqli_query($link,"SELECT * FROM tbl_pengumuman_tugas tugas, setup_kelas kelas, data_guru guru, setup_matapelajaran matapelajaran where tugas.id_guru=guru.id_guru and tugas.id_kelas=kelas.id_kelas and tugas.id_matapelajaran=matapelajaran.id_matapelajaran and tugas.id_periode='$id_periode' order by id_tugas_kelas asc");
	
	$i = 1;
	while($row=mysqli_fetch_array($view)){
	?>
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $row['nama_guru'];?></td>
		<td><?php echo $row['nama_matapelajaran'];?></td>
		<td><?php echo $row['nama_kelas'];?></td>
		<td><?php echo $row['judul_tugas'];?></td>
		<td><?php echo $row['deskripsi_tugas'];?></td>
		<td><?php echo $row['waktu_submit'];?></td>
		<td class="options-width">
		<a href="?page=pengumuman_tugas_admin&mode=delete&id_tugas_kelas=<?php echo $row['id_tugas_kelas'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete"><font color="#FF0000">Delete</font></a>            
		</td>
	</tr>
	<?php
	}
	?>
	</table>


	<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	<p>&nbsp;</p>
					
	<div class="clear"></div>
     
    </div>
    <!--  end content-table-inner ............................................END  -->
    </td>
    <td id="tbl-border-right"></td>
</tr>
<tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom"><p>&nbsp;</p></td>
    <th class="sized bottomright"></th>
</tr>
</table>