<?php
if($domain!=='ortu'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>


<?php
if($_GET['mode']=='update'){
	$id_orangtua=$_POST['id_orangtua'];
	
	$username=$_POST['username'];
	$password_lama=$_POST['password_lama'];
	
	if(empty($_POST['password'])){
		$password=$password_lama;
	}else{
		$password=md5($_POST['password']);
	}
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username' && username<>'$username_lama'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=setting_ortu&status=4";</script><?php
	}else{
	
		$query=mysqli_query($link,"update data_orangtua set username='$username', password='$password' where id_orangtua='$id_orangtua'");
		
		//user pesan
		update_user($username,$username_lama,$nama_orangtua,'orangtua');
	
		
		if($query){
			?><script language="javascript">document.location.href="?page=setting_ortu&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=setting_ortu&status=0";</script><?php
		}
	}
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
$photo=$data['photo'];
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Setting Orang Tua</h1>
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
    
			<form action="?page=setting_ortu&mode=update" method="post">
			<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
			<tr>
				<th>
				<?php 
				if(empty($photo)){
					$photo_ortu='nopic.jpg';
				}else{
					$photo_ortu=$photo;
				}
				?>
				<img src="./photo_ortu/<?php echo $photo_ortu;?>" class="imgBox" height="101" width="83">
				</th>
				<th></th>
			</tr>
			<tr>
			  <th valign="top">Nama Orang Tua </th>
			  <td><?php echo $nama_orangtua; ?></td>
			  <td></td>
			</tr>
			<tr>
			  <th valign="top">Kelamin</th>
			  <td> <?php echo $kelamin; ?>
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
			 <tr>
			  <th valign="top">Username</th>
			  <td><input type="text" class="inp-form" id="username" name="username" value="<?php echo $username; ?>"/></td>
			  <td></td>
			</tr>
			 <tr>
			  <th valign="top">Password</th>
			  <td><input type="password" title="Kosogkan jika tidak diubah" class="inp-form" name="password" value="<?php echo $password; ?>"/></td>
			  <td></td>
			</tr>
			<tr>
			  <th>&nbsp;</th>
			  <td valign="top">
					<input type="hidden" name="id_orangtua" value="<?php echo $_SESSION['id_ortu'];?>">
					<input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
					<input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
					<input type="submit" name="submit" onClick="return cek_ortu()" value="" class="form-submit" />
					<input type="reset" value="" class="form-reset"  />
			  </td>
			  <td></td>
			</tr>
		  	</table>
			</form>     
			
			<i>* Jika ada perubahan data seperti alamat, silakan hubungi Admin</i>  
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