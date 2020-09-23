<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<div id="related-activities">
    <!--  start related-act-top -->
    <div id="related-act-top"> <img src="images/forms/pengumuman_tugas.jpg" width="271" height="43" alt="" /> </div>
    <!-- end related-act-top -->
    <!--  start related-act-bottom -->
    <div id="related-act-bottom">
      <!--  start related-act-inner -->
      <div id="related-act-inner">
        <div class="left"></div>
        <div class="right"></div>
        <div class="clear"></div>
        
        <?php
		$id_siswa=$_SESSION['id_siswa'];
		$nama_siswa=$_SESSION['nama_account'];
		$nis=$_SESSION['nis'];
		$nama_kelas=$_SESSION['nama_kelas'];
		$id_kelas=$_SESSION['id_kelas'];
		?>
        
		<?php
		$view=mysqli_query($link,"SELECT * FROM tbl_pengumuman_tugas tugas, setup_kelas kelas, data_guru guru, setup_matapelajaran matapelajaran where tugas.id_guru=guru.id_guru and tugas.id_kelas=kelas.id_kelas and tugas.id_matapelajaran=matapelajaran.id_matapelajaran and tugas.id_kelas='$id_kelas' and tugas.id_periode='$id_periode' order by id_tugas_kelas asc");

		while($row=mysqli_fetch_array($view)){
			?>
			<div class="left"><a href=""><img src="images/tugas.gif" width="21" height="21" alt="" /></a></div>
       		<div class="right">

			 <h5><a href="?page=pengumuman_tugas_detail&id=<?php echo $row['id_tugas_kelas'];?>" title="Klik untuk detail tugas"><?php echo $row['judul_tugas']; ?></a></h5>
			  	 <?php echo substr($row['deskripsi_tugas'],0,100); ?>...
			</div>
			<?php
		}
		?>			
		
		
        <div class="clear"></div>
      </div>
      <!-- end related-act-inner -->
      <div class="clear"></div>
    </div>
    <!-- end related-act-bottom -->
  </div>