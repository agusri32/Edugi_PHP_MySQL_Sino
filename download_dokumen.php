<?php
if(($domain!=='guru') && $domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<!--  start page-heading -->
<div id="page-heading">
    <h1>Download Dokumen </h1>
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
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
	<tr>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Nama File</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Ukuran File</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Tanggal Upload</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Keterangan</a></th>
		<th class="table-header-repeat line-left minwidth-1"><a href="">Download</a></th>
	</tr>
	
	
	<?php
	$view=mysqli_query($link,"select * from tbl_upload_dokumen");
	
	$no=0;
	while($row=mysqli_fetch_array($view)){
	?>	
	<tr>
		<td><?php echo $no=$no+1;?></td>
		<td><?php echo $row['nama_file'];?></td>
		<td><?php echo formatBytes($row['ukuran'],0);?></td>
		<td><?php echo $row['tgl_upload'];?></td>
		<td><?php echo $row['keterangan'];?></td>
		<td><a href="<?php echo $row['url'];?>" target="_blank"><img src="images/logo-download.png" width="80" height="23"></a></td>
	</tr>
	<?php
	}
	?>
	</table>
	
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
	<br>
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