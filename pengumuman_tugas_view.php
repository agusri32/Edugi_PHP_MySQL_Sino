<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
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
    	
      	<!--  start product-table ..................................................................................... -->
        
		<?php
		$id_siswa=$_SESSION['id_siswa'];
		$nama_siswa=$_SESSION['nama_account'];
		$nis=$_SESSION['nis'];
		$nama_kelas=$_SESSION['nama_kelas'];
		$id_kelas=$_SESSION['id_kelas'];
		?>
		
        <table border="0" width="100%" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
          <th valign="top">Nama Siswa</th>
          <td><input type="text" class="inp-form" name="nama_siswa" value="<?php echo $nama_siswa;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
         <tr>
          <th valign="top">NIS</th>
          <td><input type="text" class="inp-form" name="nis" value="<?php echo $nis;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
        <tr>
          <th valign="top">Kelas</th>
          <td><input type="text" class="inp-form" name="kelas" value="<?php echo $nama_kelas;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
      </table>

		
        <form id="mainform" action="" method="post">
        <table border="0" width="70%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="6%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th width="16%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Guru</a></th>
            <th width="18%" class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
            <th width="28%" class="table-header-repeat line-left minwidth-1"><a href="">Judul Tugas</a></th>
			<th width="17%" class="table-header-repeat line-left minwidth-1"><a href="">Waktu Submit</a></th>
			<th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">Aksi</a></th>
        </tr>
        
        <?php
		
		$view=mysqli_query($link,"SELECT * FROM tbl_pengumuman_tugas tugas, setup_kelas kelas, data_guru guru, setup_matapelajaran matapelajaran where tugas.id_guru=guru.id_guru and tugas.id_kelas=kelas.id_kelas and tugas.id_matapelajaran=matapelajaran.id_matapelajaran and tugas.id_kelas='$id_kelas' and tugas.id_periode='$id_periode' order by id_tugas_kelas asc");
		
		$i = 1;
		while($row=mysqli_fetch_array($view)){
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['nama_guru'];?></td>
				<td><?php echo $row['nama_matapelajaran'];?></td>
				<td><?php echo $row['judul_tugas'];?></td>
				<td><?php echo $row['waktu_submit'];?></td>
				<td><a href="?page=pengumuman_tugas_detail&id=<?php echo $row['id_tugas_kelas'];?>"><b><font color="#0066FF">Deskripsi Tugas</font></b></a></td>
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