<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if(isset($_POST['submit'])){
	
	$jumSis = $_POST['jumlah'];
	
	for ($i=1; $i<=$jumSis; $i++)
	{
	   $id_siswa  	  = $_POST['id_siswa'.$i];
	   $nilai_tugas   = $_POST['nilai_tugas'.$i];
	   $nilai_uts     = $_POST['nilai_uts'.$i];
	   $nilai_uas     = $_POST['nilai_uas'.$i];
	   
	   $id_guru 	  = $_POST['id_guru'];
	   $id_kelas 	  = $_POST['id_kelas']; //hanya untuk parameter URL
	   $id_matapelajaran = $_POST['id_matapelajaran'];
	
	   $query = "insert into tbl_nilai values('','$id_siswa','$id_matapelajaran','$id_guru','$nilai_tugas','$nilai_uts','$nilai_uas','yes','$id_periode')";
	   $hasil=mysqli_query($link,$query);
	}
	
	if($hasil){
		?><script language="javascript">document.location.href="?page=input_nilai_selesai&id_guru=<?php echo $id_guru;?>&id_kelas=<?php echo $id_kelas;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=input_nilai_selesai&status=2";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Input Nilai</h1>
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


      	<!--  start product-table ..................................................................................... -->
        
        <!--  start step-holder -->
		<div id="step-holder">
			
		  <div class="step-no-off">1</div>
			<div class="step-light-left"><a href="?page=input_nilai">Pilih Mata Pelajaran</a></div>
			<div class="step-light-right">&nbsp;</div>
            
            <div class="step-no">2</div>
			<div class="step-dark-left">Input Nilai</div>
			<div class="step-dark-right">&nbsp;</div>
            
            
			<div class="step-no-off">3</div>
			<div class="step-light-left">Selesai</div>
			<div class="step-light-round">&nbsp;</div>
			<div class="clear"></div>
		</div>
		<!--  end step-holder -->
	
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
    
    
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
          <th valign="top">Nama Guru </th>
          <td><input type="text" class="inp-form" name="nama_siswa" value="<?php echo $nama_guru;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
         <tr>
          <th valign="top">Mata Pelajaran</th>
          <td><input type="text" class="inp-form" name="telpon_siswa" value="<?php echo $nama_matapelajaran;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
        <tr>
          <th valign="top">Kelas</th>
          <td><input type="text" class="inp-form" name="nis" value="<?php echo $nama_kelas;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
      </table>
      <br />
      
        <form id="mainform" action="home.php?page=input_nilai_siswa" method="post">
        <table border="0" width="70%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th width="20%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
            <th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">nis</a></th>
            <th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nilai Tugas </a></th>
			<th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nilai UTS </a></th>
			<th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nilai UAS </a></th>
        </tr>
        
        
        <?php
		$view=mysqli_query($link,"SELECT * FROM tbl_ruangan ruangan, data_siswa siswa WHERE ruangan.id_siswa=siswa.id_siswa and ruangan.id_kelas='$id_kelas' order by siswa.nama_siswa asc");
		
		$i = 1;
		while($row=mysqli_fetch_array($view)){
			?>
			<input type="hidden" name="id_guru" value="<?php echo $id_guru;?>" />
			<input type="hidden" name="id_matapelajaran" value="<?php echo $id_matapelajaran;?>" />	
			<input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>" />
			<?php echo "<input type='hidden' name='id_siswa".$i."' value='".$row['id_siswa']."' />"; ?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['nama_siswa'];?></td>
				<td><?php echo $row['nis'];?></td>
				<td><?php echo "<input type='text' name='nilai_tugas".$i."' size='7'/>"; ?></td>
				<td><?php echo "<input type='text' name='nilai_uts".$i."' size='7'/>"; ?></td>
				<td><?php echo "<input type='text' name='nilai_uas".$i."' size='7'/>"; ?></td>
			</tr>
			<?php
			$i++;
		}
			$jumSis = $i-1;
		?>
        <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" />
        <tr>
            <td colspan="6" align="center"><input type="submit" onclick="return confirm('Apakah Anda yakin?')" value="Input Nilai" name="submit" class="form-submit" /></td>
        </tr>
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
