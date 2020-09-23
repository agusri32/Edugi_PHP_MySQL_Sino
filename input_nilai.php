<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if(isset($_GET['id_guru'])){
	
	$id_guru=$_GET['id_guru'];
	$id_kelas=$_GET['id_kelas'];
	$id_matapelajaran=$_GET['id_matapelajaran'];
	
	//query berdasarkan guru, kelas, dan matapelajaran
	$query=mysqli_query($link,"select * from tbl_nilai nilai, data_siswa siswa, tbl_ruangan ruangan where nilai.id_siswa=siswa.id_siswa and nilai.id_siswa=ruangan.id_siswa and nilai.id_guru='$id_guru' and nilai.id_matapelajaran='$id_matapelajaran' and ruangan.id_kelas='$id_kelas' and nilai.id_periode='$id_periode'");
	$cek=mysqli_num_rows($query);
	
	if($cek==0){
		//kalo belum ada mode input
		?><script language="javascript">document.location.href="?page=input_nilai_siswa&id_guru=<?php echo $id_guru;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>&id_kelas=<?php echo $id_kelas;?>";</script><?php
	}else{
		//jika mau update harus hubungi admin untuk buka kunci
		$query_kunci=mysqli_query($link,"select * from tbl_nilai nilai, data_siswa siswa, tbl_ruangan ruangan where nilai.id_siswa=siswa.id_siswa and nilai.id_siswa=ruangan.id_siswa and nilai.id_guru='$id_guru' and nilai.id_matapelajaran='$id_matapelajaran' and ruangan.id_kelas='$id_kelas' and nilai.kunci='yes' and nilai.id_periode='$id_periode'");
		$cek_kunci=mysqli_num_rows($query_kunci);
		
		if($cek_kunci!==0){
			//jika sudah terkunci
			?><script language="javascript">document.location.href="?page=input_nilai_selesai&id_guru=<?php echo $id_guru;?>&id_kelas=<?php echo $id_kelas;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>";</script><?php
		}else{		
			//kalo sudah ada mode update
			?><script language="javascript">document.location.href="?page=input_nilai_update&id_guru=<?php echo $id_guru;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>&id_kelas=<?php echo $id_kelas;?>";</script><?php
		}
	}
	
}else{
	unset($_POST['id_guru']);
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
			if($_GET['status']=='1'){
			?>
			
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left">Alhamdulilah sesuatu banget, Data berhasil disimpan :)</td>
                <td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
			<?php
			}
			
			if($_GET['status']=='0'){
			?>

            <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="red-left">Yach data gagal di simpan, cape dech!</td>
                <td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
			<?php
			}
			?>


      	<!--  start product-table ..................................................................................... -->
        
        <!--  start step-holder -->
		<div id="step-holder">
			<div class="step-no">1</div>
			<div class="step-dark-left">Pilih Mata Pelajaran</div>
			<div class="step-dark-right">&nbsp;</div>
			<div class="step-no-off">2</div>
			<div class="step-light-left">Input Nilai</div>
			<div class="step-light-right">&nbsp;</div>
			<div class="step-no-off">3</div>
			<div class="step-light-left">Selesai</div>
			<div class="step-light-round">&nbsp;</div>
			<div class="clear"></div>
		</div>
		<!--  end step-holder -->
	
        
        
        <form id="mainform" action="">
        <table border="0" width="48%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th width="60%" class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
            <th width="30%" class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
        </tr>
        
        
        <?php
		$id_guru=$_SESSION['id_guru'];
		$view=mysqli_query($link,"select * from tbl_jadwal_mengajar jadwal, setup_kelas kelas, setup_matapelajaran matapelajaran where jadwal.id_kelas=kelas.id_kelas and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_guru='$id_guru' and jadwal.id_periode='$id_periode' order by id_jadwal asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><a href="?page=input_nilai&id_guru=<?php echo $id_guru;?>&id_matapelajaran=<?php echo $row['id_matapelajaran'];?>&id_kelas=<?php echo $row['id_kelas'];?>" style="text-decoration:underline" title="Pilih Mata matapelajaran"><?php echo $row['nama_matapelajaran'];?></a></td>
            <td><?php echo $row['nama_kelas'];?></td>
        </tr>
		<?php
		}
		?>
        </table>
        <!--  end product-table................................... --> 
        <p>&nbsp;</p>
        <p>&nbsp;</p>
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
