<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}

if($domain=='siswa' && $pesan_siswa=='no'){
	?><script language="javascript">document.location.href="?page=dashboard"</script><?php
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Pesan Keluar</h1>
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
    

	<form id="mainform" action="">
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
	<tr>
	<th width="9%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
	<th width="19%" class="table-header-repeat line-left minwidth-1"><a href="">Penerima</a></th>
	<th width="28%" class="table-header-repeat line-left minwidth-1"><a href="">Subject</a></th>
	<th width="29%" class="table-header-repeat line-left minwidth-1"><a href="">Pesan</a></th>
	<th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">Tanggal</a></th>
	</tr>
	
	
	<?php
	$query=mysqli_query($link,"select * from tbl_user_pesan user, tbl_pesan inbox where inbox.id_user='$id_user' and inbox.id_teman=user.id_user order by tanggal desc",$koneksi);
	
	while($row=mysqli_fetch_array($query)){
	?>	
		<tr>
		<td><?php echo $no=$no+1;?></td>
		<td><?php echo $row['nama_user']." (".$row['domain'].")";?></td>
		<td><?php echo $row['subject'];?></td>
		<td><?php echo $row['message'];?></td>
		<td><?php echo $row['tanggal'];?></td>
		</tr>
		<?php
	}
	?>
	</table>
	<!--  end product-table................................... --> 
	</form>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

     
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