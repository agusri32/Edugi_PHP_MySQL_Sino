<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if(isset($_POST['kuesioner'])){

	$kuesioner=$_POST['kuesioner'];
	
	if($kuesioner=='buka'){
		$query=mysqli_query($link,"update setup_sistem set nilai_setup='buka' where nama_setup='akses_kuesioner'");
	}
	
	if($kuesioner=='tutup'){
		$query=mysqli_query($link,"update setup_sistem set nilai_setup='tutup' where nama_setup='akses_kuesioner'");
			   mysqli_query($link,"TRUNCATE `tbl_kuesioner`");
			   mysqli_query($link,"TRUNCATE `tbl_kuesioner_history`");
	}
	
	if($query){
		?><script language="javascript">document.location.href="?page=setup_kuesioner_open&status=3";</script><?php
	}	
}else{
	unset($_POST['kuesioner']);
}
?>

<!--  start page-heading -->
<style type="text/css">
<!--
.style1 {
	color: #0066FF;
	font-weight: bold;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>


<div id="page-heading">
    <h1>Akses Kuesioner</h1>
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
	
	<center>
	<?php
	$cek=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='akses_kuesioner'"));
	$kuis=$cek['nilai_setup'];
	?>
	<p>
	<?php
	if($kuis=='tutup'){
		echo "Status Kuesioner : <font color='red'><b>".ucwords($kuis)."</b></font>";
	}else{
		echo "Status Kuesioner : <font color='blue'><b>".ucwords($kuis)."</b></font>";
	}
	?>
	</p>
	<br><br>
	<form action="?page=setup_kuesioner_open" method="post">   
	<table>
	<tr>
		<td>
		<select name="kuesioner"  class="styledselect_form_1">
		  <option value="buka" <?php if($kuis=='tutup'){ echo "selected"; } ?>>Buka Kuesioner</option>
		  <option value="tutup" <?php if($kuis=='buka'){ echo "selected"; } ?>>Tutup Kuesioner</option>
		</select>	
		</td>
		<td>&nbsp;</td>
		<td>
		<input type="submit" name="submit" onClick="return confirm('Apakah anda yakin?')" value="" class="form-submit" />
		</td>
	</tr>
	</table>
	</form>
	</center>
				
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
		<p><i> * Dengan <span class="style1">membuka</span> kuesioner, siswa dapat menginput penilaian terhadap guru
	      <br>
		  * Hasil Akumulasi penilaian dapat dilihat per guru
		  <br>
		  * Admin dapat melihat semua data kuesioner guru
		  <br>
		  * Dengan <span class="style2">menutup</span> kuesioner, data kuesioner akan dihapus, menu quesioner disiswa dihilangkan
	    </i></p>
	<br>
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
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
</tr>
</table>