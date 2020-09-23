<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}

if($kuesioner!=='buka'){
	?><script language="javascript">document.location.href="?page=dashboard"</script><?php
}
?>

<?php
if (isset($_POST['submit'])){
	$id_guru=$_POST['id_guru'];
	$id_siswa=$_POST['id_siswa'];
	
	$id_tanya=$_POST["id"];
	$pilihan=$_POST["pilihan"];
	$jumlah=$_POST['jumlah'];
	
	for ($i=0;$i<$jumlah;$i++){
		$id_pertanyaan=$id_tanya[$i];
		$jawaban=$pilihan[$id_pertanyaan];
		
		$simpan=mysqli_query($link,"insert into tbl_kuesioner values('','$id_guru','$id_pertanyaan','$id_siswa','$jawaban')");
	}
	

	if($simpan){
		$simpan_history=mysqli_query($link,"insert into tbl_kuesioner_history values('','$id_siswa','$id_guru')");
		?><script language="javascript">document.location.href="?page=kuesioner_review&id_guru=<?php echo $id_guru;?>&id_siswa=<?php echo $id_siswa;?>&status=9";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}
?>


<!--  start page-heading -->
<div id="page-heading">
    <h1>Kuisioner Penilaian Guru</h1>
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
    	
	<div class="clear"></div>
     
    </div>
    <!--  end content-table-inner ............................................END  -->
    </td>
    <td id="tbl-b/order-right"></td>
</tr>
<tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
</tr>
</table>