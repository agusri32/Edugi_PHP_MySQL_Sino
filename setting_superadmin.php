<?php
if($domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>


<?php
if($_GET['mode']=='update'){
	$id_superadmin=$_POST['id_superadmin'];
	$nama_superadmin=$_POST['nama_superadmin'];
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
		?><script language="javascript">document.location.href="?page=setting_superadmin&status=4";</script><?php
	}else{
		$query=mysqli_query($link,"update user_superadmin set nama_superadmin='$nama_superadmin',username='$username', password='$password' where id_superadmin='$id_superadmin'");
		
		//user pesan
		update_user($username,$username_lama,$nama_superadmin,'superadmin');
		
		if($query){
			?><script language="javascript">document.location.href="?page=setting_superadmin&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=setting_superadmin&status=0";</script><?php
		}
	}
}

$id_superadmin=$_SESSION['id_superadmin'];
$edit=mysqli_query($link,"select * from user_superadmin where id_superadmin='$id_superadmin'");

$data=mysqli_fetch_array($edit);
$nama_superadmin=$data['nama_superadmin'];
$username=$data['username'];

$username_lama=$data['username'];
$password_lama=$data['password'];
?>


<!--  start page-heading -->
<div id="page-heading">
    <h1>Setting Superadmin</h1>
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
    
			<form action="?page=setting_superadmin&mode=update" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Nama Superadmin </th>
                      <td><input type="text" class="inp-form" id="nama_superadmin" name="nama_superadmin" value="<?php echo $nama_superadmin; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Username</th>
                      <td><input type="text" class="inp-form" id="username" name="username" value="<?php echo $username; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Password</th>
                      <td><input type="password" class="inp-form" name="password" value="<?php echo $password; ?>"/> *Kosogkan jika tidak diubah</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_superadmin" value="<?php echo $id_superadmin;?>">
							<input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
							<input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
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
			
			<i>* Input Data superadmin langsung melalui Database (PHPMyadmin)</i>  
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