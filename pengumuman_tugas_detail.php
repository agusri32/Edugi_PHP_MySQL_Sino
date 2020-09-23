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
		
        <?php
		$id_tugas=$_GET['id'];
		
		$view=mysqli_fetch_array(mysqli_query($link,"SELECT * FROM tbl_pengumuman_tugas tugas, setup_kelas kelas, data_guru guru, setup_matapelajaran matapelajaran where tugas.id_guru=guru.id_guru and tugas.id_kelas=kelas.id_kelas and tugas.id_matapelajaran=matapelajaran.id_matapelajaran and tugas.id_kelas='$id_kelas' and tugas.id_periode='$id_periode' and tugas.id_tugas_kelas='$id_tugas' order by id_tugas_kelas asc"));

		?>
        <table border="0" width="100%" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
          <th valign="top">Nama Guru</th>
          <td>: <?php echo $view['nama_guru'];?></td>
          <td></td>
        </tr>
         <tr>
          <th valign="top">Mata Pelajaran</th>
          <td>: <?php echo $view['nama_matapelajaran'];?></td>
          <td></td>
        </tr>
        <tr>
          <th valign="top">Judul Tugas</th>
          <td>: <?php echo $view['judul_tugas'];?></td>
          <td></td>
        </tr>
        <tr>
          <th valign="top">Waktu Submit</th>
          <td>: <?php echo $view['waktu_submit'];?></td>
          <td></td>
        </tr>
        <tr>
          <th valign="top">Deskripsi Tugas</th>
          <td>: <b><?php echo $view['deskripsi_tugas'];?></b></td>
          <td></td>
        </tr>
        
      </table>
      <br /><br />
	  <a href="?page=pengumuman_tugas_view"><b><font color="#0099FF">Kembali ke Halaman Utama</font></b></a>
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