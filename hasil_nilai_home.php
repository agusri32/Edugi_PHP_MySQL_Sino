<?php
if($domain!=='ortu'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}

$id_orangtua=$_SESSION['id_ortu'];
$edit=mysqli_query($link,"select * from data_orangtua where id_orangtua='$id_orangtua'");

$data=mysqli_fetch_array($edit);
$nama_orangtua=$data['nama_orangtua'];
$kelamin=$data['kelamin'];
$status_keluarga=$data['status_keluarga'];
$alamat_orangtua=$data['alamat_orangtua'];
$telpon_orangtua=$data['telpon_orangtua'];
$username=$data['username'];
$password_lama=$data['password'];

?>
<!--  start page-heading -->
<div id="page-heading">
    <h1> Akses Orang Tua </h1>
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
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
		  <th valign="top">Nama Orang Tua </th>
		  <td><?php echo $nama_orangtua; ?></td>
		  <td></td>
		</tr>
		<tr>
		  <th valign="top">Kelamin</th>
		  <td> <?php echo ucwords($kelamin); ?>
		  </td>
		  <td></td>
		</tr>
		<tr>
		  <th valign="top">Status Keluarga</th>
		  <td> <?php echo $status_keluarga; ?>
		  </td>
		  <td></td>
		</tr>
		<tr>
		  <th valign="top">Alamat</th>
		  <td><?php echo $alamat_orangtua; ?></td>
		  <td></td>
		</tr>
		 <tr>
		  <th valign="top">Telpon </th>
		  <td><?php echo $telpon_orangtua; ?></td>
		  <td></td>
		</tr>
		</table>


        <form id="mainform" action="">
        <table border="0" width="80%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="13%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
            <th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
			<th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
			<th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Rekap Nilai</a></th>
			<th width="40%" class="table-header-repeat line-left minwidth-1"><a href="">Nilai_Semester</a></th>
            </tr>
        
        
        <?php
		$id_ortu=$_SESSION['id_ortu'];
		$view=mysqli_query($link,"select * from tbl_akses_ortu akses, data_orangtua orangtua, data_siswa siswa where akses.id_siswa=siswa.id_siswa and akses.id_orangtua=orangtua.id_orangtua and akses.id_orangtua='$id_ortu' order by id_akses asc");
		$no=0;
		while($row=mysqli_fetch_array($view)){
		$id_siswa=$row['id_siswa'];
		$rowkelas=mysqli_fetch_array(mysqli_query($link,"select * from tbl_ruangan ruangan, setup_kelas kelas where ruangan.id_kelas=kelas.id_kelas and ruangan.id_siswa='$id_siswa'"));
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><a href="?page=hasil_nilai_siswa&id_siswa=<?php echo $row['id_siswa']; ?>" title="Klik untuk melihat nilai siswa"><?php echo $row['nama_siswa'];?></a></td>
            <td><?php echo $row['nis'];?></td>
			<td><?php echo $rowkelas['nama_kelas'];?></td>
			<td><a href="?page=hasil_nilai_siswa&id_siswa=<?php echo $row['id_siswa']; ?>" title="Klik untuk melihat nilai siswa"><font color="#0066FF">Hasil Nilai</font></a></td>
			<td><a href="?page=hasil_nilai_semester&id_siswa=<?php echo $row['id_siswa']; ?>" title="Klik untuk melihat nilai siswa"><font color="#0066FF">Hasil Nilai</font></a></td>
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
