<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Laporan Jadwal Ujian </h1>
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
	  
	  
		<p><em><br />
		</em> </p>           
			<p>&nbsp;</p>
		<!--  start product-table ..................................................................................... -->
        <?php
		if(isset($_POST['submit'])){
			$id_matapelajaran=htmlentities($_POST['id_matapelajaran']);
			$id_kelas=htmlentities($_POST['id_kelas']);
			$id_ruang_kelas=htmlentities($_POST['id_ruang_kelas']);

			
			if($id_ruang_kelas!=="0"){
				$filter_ruang="and jadwal.id_ruang_kelas='$id_ruang_kelas'";
			}else{
				$filter_ruang="";
			}
			
			if($id_matapelajaran!=="0"){
				$filter_matapelajaran="and jadwal.id_matapelajaran='$id_matapelajaran'";
			}else{
				$filter_matapelajaran="";
			}
			
			if($id_kelas!=="0"){
				$filter_kelas="and jadwal.id_kelas='$id_kelas'";
			}else{
				$filter_kelas="";
			}
			
		}else{
			unset($_POST['submit']);
		}
		$result=mysqli_query($link,"select * from tbl_jadwal_ujian jadwal, setup_kelas kelas, setup_ruang_kelas ruang, setup_matapelajaran matapelajaran where jadwal.id_kelas=kelas.id_kelas and jadwal.id_ruang_kelas=ruang.id_ruang_kelas and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_kelas='$id_kelas' and jadwal.id_periode='$id_periode' order by id_ujian asc"); //output
		?>
		<form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Ruang Kelas</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Tanggal</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Jam</a></th>
        </tr>
        
        
        <?php
		$no=0;
		while($row=mysqli_fetch_array($result)){
		?>	
		<tr>
            <td><?php echo $offset=$offset+1;?></td>
            <td><?php echo $row['nama_matapelajaran'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
			<td><?php echo $row['nama_ruang_kelas'];?></td>
			<td><?php echo $row['tanggal'];?></td>
			<td><?php echo $row['jam'];?></td>
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