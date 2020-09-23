<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if($_GET['mode']=='reply'){
	$id_user=$_POST['id_user'];
	$user_inbox=$_POST['user_inbox'];
	$id_reply=$_POST['id_inbox'];
	$pesan=addslashes(htmlentities($_POST['pesan']));
	$tanggal=$_POST['tanggal'];
	
	if(empty($pesan)){
				?><script language="javascript">document.location.href="?page=pesan_kirim&status=0";</script><?php
	}else{

		$query=mysqli_query($link,"insert into tbl_pesan values('','$id_user','','$id_reply','','$pesan','$tanggal','no')");
	
		if($query){	
			?><script language="javascript">document.location.href="?page=inbox_open&id_inbox=<?php echo $id_reply; ?>&user_inbox=<?php echo $user_inbox; ?>&stat=Pesan sudah terkirim :)";</script><?php
		}else{
			echo mysqli_error();
		}
	}
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Balas Pesan</h1>
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
	$dibaca=mysqli_query($link,"update tbl_pesan set dibaca='yes' where id_inbox='$_GET[id_inbox]' and id_teman='$id_user'");
	$dibaca_reply=mysqli_query($link,"update tbl_pesan set dibaca='yes' where id_reply='$_GET[id_inbox]' and id_user<>'$id_user'");

	$row_inbox=mysqli_fetch_array(mysqli_query($link,"select * from tbl_pesan where id_inbox='$_GET[id_inbox]'"));	
	$row_user=mysqli_fetch_array(mysqli_query($link,"select * from tbl_user_pesan where id_user='$_GET[user_inbox]'"));	
	
	if($row_inbox['id_user']==$id_user){
		$status_in="To";
		$user_inbox=$row['id_teman'];
	}else{
		$status_in="From";
		$user_inbox=$row['id_user'];
	}
	?>
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td><!--  start step-holder -->
	<!--  end step-holder -->
	  <!-- start id-form -->
	  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
		  <th valign="top">Tanggal</th>
		  <td><?php echo $row_inbox['tanggal']; ?></td>
		  <td></td>
		</tr>


		 <tr>
		  <th valign="top">Pengirim</th>
		  <td><?php echo $row_user['nama_user']; ?></td>
		  <td></td>
		</tr>
		
		<tr>
		  <th valign="top">Subject</th>
		  <td><?php echo $row_inbox['subject']; ?></td>
		  <td></td>
		</tr>

		 <tr>
		  <th valign="top">Pesan</th>
		  <td><?php echo $row_inbox['message']; ?></td>
		  <td></td>
		</tr>	  
		
	</table>
	<!-- end id-form  -->
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

	
    <form action="?page=inbox_open&mode=reply" method="post">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td><!--  start step-holder -->
	<!--  end step-holder -->
	  <!-- start id-form -->
	  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		 <tr>
		  <th valign="top">Balas Pesan</th>
		  <td><textarea name="pesan" cols="30" rows="5"></textarea></td>
		  <td></td>
		</tr>
		<tr>
		  <th><a href="?page=pesan_masuk"><font color="#0099FF">Kembali</font></a></th>
		  <td valign="top">
				<input type="hidden" name="tanggal" value="<?php echo $waktu; ?>" />
				<input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
				<input type="hidden" name="user_inbox" value="<?php echo $_GET['user_inbox']; ?>" />
				<input type="hidden" name="id_inbox" value="<?php echo $_GET['id_inbox']; ?>" />

				<input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="" class="form-submit" />
		  </td>
		  <td></td>
		</tr>
	  </table>
	<!-- end id-form  -->
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
	
	
	
	
	
	<form id="mainform" action="">
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
	<tr>
	<th width="9%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
	<th width="18%" class="table-header-repeat line-left minwidth-1"><a href="">Pengirim</a></th>
	<th width="55%" class="table-header-repeat line-left minwidth-1"><a href="">Pesan</a></th>
	<th width="18%" class="table-header-repeat line-left minwidth-1"><a href="">Tanggal</a></th>
	</tr>
	
	
	<?php
	$view_pesan=mysqli_query($link,"select * from tbl_pesan reply, tbl_user_pesan user where reply.id_reply='$_GET[id_inbox]' and reply.id_user=user.id_user order by tanggal desc");
	
	while($row=mysqli_fetch_array($view_pesan)){
		?>
		<tr>
		<td><?php echo $no=$no+1;?></td>
		<td><?php
		 if($row['id_user']==$id_user){
		 	echo "You";
		 }else{
		 	echo "<font color='blue'>".$row['nama_user']."</font>";
		 }
		 ?></td>
		<td><?php 
		if($row['id_user']==$id_user){
		 	echo $row['message'];
		}else{
			echo "<font color='blue'>".$row['message']."</font>";
		}
		?></td>
		<td><?php 
		if($row['id_user']==$id_user){
		 	echo $row['tanggal'];
		}else{
			echo "<font color='blue'>".$row['tanggal']."</font>";
		}
		?></td>
		</tr>
		<?php
	}
	?>
	</table>
	<!--  end product-table................................... --> 
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