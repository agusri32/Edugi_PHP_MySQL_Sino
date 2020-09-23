<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<!--  start page-heading -->
<div id="page-heading">
    <h1>Kotak Pesan </h1>
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
	
	<form id="mainform" action="">
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
	<tr>
	<th width="7%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
	<th width="18%" class="table-header-repeat line-left minwidth-1"><a href="">Nama User </a></th>
	<th width="23%" class="table-header-repeat line-left minwidth-1"><a href="">Subject</a></th>
	<th width="26%" class="table-header-repeat line-left minwidth-1"><a href="">Pesan</a></th>
	<th width="14%" class="table-header-repeat line-left minwidth-1"><a href="">Tanggal</a></th>
	<th width="12%" class="table-header-repeat line-left minwidth-1"><a href="">Aksi</a></th>
	</tr>
	
	
	<?php
	$query=mysqli_query($link,"select * from tbl_pesan where id_reply=0 and id_user='$id_user' or id_teman='$id_user'  order by tanggal desc");
	
	while($row=mysqli_fetch_array($query)){
		$id_inbox=$row['id_inbox'];
	
		if($row['id_user']==$id_user){
			$status_in="To";
			$user_inbox=$row['id_teman'];
		}else{
			$status_in="From";
			$user_inbox=$row['id_user'];
		}
	
		$query_cek1=mysqli_query($link,"select id_user from tbl_pesan where id_inbox='$id_inbox' and dibaca='no' and id_user!='$id_user' order by tanggal desc");
		$cek1=mysqli_num_rows($query_cek1);
		
		$query_cek2=mysqli_query($link,"select id_user from tbl_pesan where id_reply='$id_inbox' and dibaca='no' and id_user!='$id_user' order by tanggal desc");
		$cek2=mysqli_num_rows($query_cek2);
			
		if($cek1!==0 || $cek2!==0){
			$baru="<img src='./images/baru.gif'  style='border:none'>";
		}else{
			$baru="";
		}
		
		$row_user=mysqli_fetch_array(mysqli_query($link,"select nama_user from tbl_user_pesan where id_user='$user_inbox'"));
		?>
	
		<tr>
		<td><?php echo $no=$no+1;?> <?php if($baru!=""){ echo $baru; }?></td>
		<td><?php echo $status_in." : ".$row_user['nama_user'];?></td>
		<td><?php echo $row['subject'];?></td>
		<td><?php echo $row['message'];?></td>
		<td><?php echo $row['tanggal'];?></td>
		<td><a href="?page=inbox_open&id_inbox=<?php echo $row['id_inbox'];?>&user_inbox=<?php echo $user_inbox;?>&dibaca='yes'"><font color="#00CC00">Balas Pesan</font></a></td>
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