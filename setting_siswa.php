<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if($_GET['mode']=='update'){
	$id_siswa=$_POST['id_siswa'];
	$nama_siswa=$_POST['nama_siswa'];
	$username=$_POST['username'];
	
	$username_lama=$_POST['username_lama'];
	$password_lama=$_POST['password_lama'];
	
	if(empty($_POST['password'])){
		$password=$password_lama;
	}else{
		$password=md5($_POST['password']);
	}
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username' && username<>'$username_lama'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=setting_siswa&status=4";</script><?php
	}else{				
		//setelah dilakukan pengecekan username
		$query=mysqli_query($link,"update data_siswa set username='$username', password='$password' where id_siswa='$id_siswa'");
		
		//user pesan
		update_user($username,$username_lama,$nama_siswa,'siswa');
		
		if($query){
			?><script language="javascript">document.location.href="?page=setting_siswa&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=setting_siswa&status=0";</script><?php
		}
	}	
}

$id_siswa=$_SESSION['id_siswa'];
$edit=mysqli_query($link,"select * from data_siswa where id_siswa='$id_siswa'");

$data=mysqli_fetch_array($edit);
$nama_siswa=$data['nama_siswa'];
$nis=$data['nis'];
$kelamin=$data['kelamin'];
$alamat_siswa=$data['alamat_siswa'];
$telpon_siswa=$data['telpon_siswa'];
$username=$data['username'];

$username_lama=$data['username'];
$password_lama=$data['password'];
$photo=$data['photo'];
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Setting Siswa</h1>
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
    
			<form action="?page=setting_siswa&mode=update" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
						<th>
						<?php 
						if(empty($photo)){
							$photo_siswa='nopic.jpg';
						}else{
							$photo_siswa=$photo;
						}
						?>
						<img src="./photo_siswa/<?php echo $photo_siswa;?>" class="imgBox" height="101" width="83">
						</th>
						<th></th>
					</tr>
					<tr>
                      <th valign="top">Nama Siswa </th>
                      <td><?php echo $nama_siswa; ?></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">NIS</th>
                      <td><?php echo $nis; ?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">Kelamin</th>
                      <td>
					  <?php echo $data['kelamin'];?>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">Alamat</th>
                      <td><?php echo $alamat_siswa; ?></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Telpon </th>
                      <td><?php echo $telpon_siswa; ?></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Username</th>
                      <td><input type="text" class="inp-form" id="username" name="username" value="<?php echo $username; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Password</th>
                      <td><input type="password" title="Kosogkan jika tidak diubah" class="inp-form" name="password" value="<?php echo $password; ?>"/> </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_siswa" value="<?php echo $id_siswa;?>">
							<input type="hidden" name="nama_siswa" value="<?php echo $nama_siswa;?>">
							<input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
							<input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
					  		<input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="" class="form-submit" />
                      </td>
                      <td></td>
                    </tr>
                  </table>
                <!-- end id-form  -->
              </td>
              <td><!--  start related-activities -->
              </td>
            </tr>
            <tr>
              <td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
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