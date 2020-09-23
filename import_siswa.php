<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Import Data Siswa</h1>
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
    <div id="content-table-inner" align="center">
  	<img src="images/logo-excel.jpg" width="114" height="117" style="border:none ">
	<?php
	if(isset($_POST['upload'])){
		include"upload_data_siswa.php";
	}
	?>
	<br>	  		
	<form name="upload" enctype="multipart/form-data" action="?page=import_siswa" id="upload" method="post"  />
		<table width=auto>
		<tr>
			<td> <b>Browse Excel</b> &nbsp;</td>
			<td><input size=50 type="file" name="userfile" ></td>
			<td><input type="submit" onclick="return confirm('Apakah Anda yakin akan import data ke table?')" class="form-submit" name="upload" Value="Proses Upload"></td>
		</tr>
		</table>
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
