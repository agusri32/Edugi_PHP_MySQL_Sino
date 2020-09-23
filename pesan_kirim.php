<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}

if($domain=='siswa' && $pesan_siswa=='no'){
	?><script language="javascript">document.location.href="?page=dashboard"</script><?php
}
?>

<?php
if($_GET['mode']=='kirim_inbox'){
	$id_user=$_POST['id_user'];
	$id_teman=$_POST['id_teman'];
	$subject=ucwords(addslashes(htmlentities($_POST['subject'])));
	$pesan=addslashes(htmlentities($_POST['pesan']));
	$tanggal=$_POST['tanggal'];
	
	if($id_teman==$_SESSION['id_user']){
		?><script language="javascript">document.location.href="?page=pesan_kirim&status=0";</script><?php
	}else{
		
		if(empty($subject) || empty($pesan)){
				?><script language="javascript">document.location.href="?page=pesan_kirim&status=0";</script><?php
		}else{
	
			$query=mysqli_query($link,"insert into tbl_pesan values('','$id_user','$id_teman','','$subject','$pesan','$tanggal','no')");
		
			if($query){	
				?><script language="javascript">document.location.href="?page=pesan_kirim&status=7";</script><?php
			}else{
				echo mysqli_error();
			}
		}
	}
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Kirim Pesan</h1>
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
    
    <form action="?page=pesan_kirim&mode=kirim_inbox" method="post">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td><!--  start step-holder -->
	<!--  end step-holder -->
	  <!-- start id-form -->
	  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
	  
	  
		<tr>
		  <th valign="top">Kategori Penerima</th>
		  <td>
		
			<select name="domain" id="domain" onChange="user_domain(domain.value)">
			<option value="0" selected="selected">--- Pilih Kategori ---</option>
			<?php
			//update sinov32 bahwa ortu boleh mengirim pesan.
			//$query=mysqli_query($link,"select distinct(domain) from tbl_user_pesan where domain!='orangtua' order by domain asc");
			$query=mysqli_query($link,"select distinct(domain) from tbl_user_pesan order by domain asc");
			
			while($row=mysqli_fetch_array($query))
			{
				?><option value="<?php echo $row['domain']; ?>"><?php echo ucwords($row['domain']); ?></option><?php
			}
			?>
			</select>		
				
		  </td>
		  <td></td>
		</tr>


		<tr>
		  <th valign="top">Nama Penerima</th>
		  <td>
				<div id="nama_user_view"></div>
		  </td>
		  <td></td>
		</tr>
		
			
		 <tr>
		  <th valign="top">Subjek</th>
		  <td><input type="text" name="subject"></td>
		  <td></td>
		</tr>
		 <tr>
		  <th valign="top">Pesan</th>
		  <td><textarea name="pesan" cols="30" rows="5"></textarea></td>
		  <td></td>
		</tr>
		<tr>
		  <th>&nbsp;</th>
		  <td valign="top">
		  		<input type="hidden" name="tanggal" value="<?php echo $waktu; ?>" />
				<input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>" />
				<input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="" class="form-submit" />
		  </td>
		  <td></td>
		</tr>
	  </table>
	<!-- end id-form  -->
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p></td>
	<td><!--  start related-activities -->
	</td>
	</tr>
	<tr>
	<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
	<td></td>
	</tr>
	</table>
	</form>     
	


     
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