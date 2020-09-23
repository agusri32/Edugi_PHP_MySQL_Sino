<?php
if($domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if($_GET['mode']=='input'){
	
	$nama_admin=ucwords(htmlentities($_POST['nama_admin']));
	$username=htmlentities($_POST['username']);
	$password=md5(htmlentities($_POST['password']));
	
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=data_admin&status=5";</script><?php
	}else{
			
		$query=mysqli_query($link,"insert into user_admin values('','$nama_admin','$username','$password','no')");
		
		//user pesan
		insert_user($username,$nama_admin,'admin');
		
		if($query){
			?><script language="javascript">document.location.href="?page=data_admin&status=1";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_admin&status=0";</script><?php
		}
		
	}
}


if($_GET['mode']=='delete'){
	$username=$_GET['username'];
	$id_admin=$_GET['id_admin'];
	$query=mysqli_query($link,"delete from user_admin where id_admin='$id_admin'");
	
	//user pesan
	delete_user($username);
	
	if($query){
		?><script language="javascript">document.location.href="?page=data_admin&status=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_admin&status=0";</script><?php
	}
}

if($_GET['mode']=='change'){
	
	$locked=$_GET['locked'];
	$id_admin=$_GET['id_admin'];
	
	$query=mysqli_query($link,"UPDATE user_admin SET `locked` = '$locked' WHERE `id_admin`= '$id_admin'");
	if($query){
		?><script language="javascript">document.location.href="?page=data_admin&status=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_admin&status=0";</script><?php
	}
}


if($_GET['mode']=='update'){
	$id_admin=$_POST['id_admin'];
	$nama_admin=$_POST['nama_admin'];
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
		?><script language="javascript">document.location.href="?page=data_admin&status=4";</script><?php
	}else{
		
		$query=mysqli_query($link,"update user_admin set nama_admin='$nama_admin',username='$username', password='$password' where id_admin='$id_admin'");
	
		//user pesan
		update_user($username,$username_lama,$nama_admin,'admin');
		
		if($query){
			?><script language="javascript">document.location.href="?page=data_admin&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_admin&status=0";</script><?php
		}	
	}
}

if($_GET['mode']=='edit'){
	$id_admin=$_GET['id_admin'];
	$edit=mysqli_query($link,"select * from user_admin where id_admin='$id_admin'");
	$data=mysqli_fetch_array($edit);
	$nama_admin=$data['nama_admin'];
	$username=$data['username'];
	
	$username_lama=$data['username'];
	$password_lama=$data['password'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Data Administrator</h1>
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
			if($_GET['mode']=='edit'){
				?><form action="?page=data_admin&mode=update" method="post"><?php 
			}else{
				?><form action="?page=data_admin&mode=input" method="post"><?php
			}
			?>
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Nama Admin </th>
                      <td><input type="text" class="inp-form" id="nama_admin" name="nama_admin" value="<?php echo $nama_admin; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Username</th>
                      <td><input type="text" class="inp-form" id="username" name="username" value="<?php echo $username; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Password</th>
                      <td><input type="password" class="inp-form" id="password" name="password" value="<?php echo $password; ?>"/> *Kosogkan jika tidak diubah</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_admin" value="<?php echo $_GET['id_admin'];?>">
							<input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
							<input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
					  		<input type="submit" name="submit" onClick="return cek_admin()" value="" class="form-submit" />
                          	<input type="reset" value="" class="form-reset"  />
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
		<i>
		<p> * Data induk tidak disarankan untuk dihapus jika sistem sudah berjalan. 
		<br>* Disarankan hanya untuk update atau insert. 
		<br>* Karena Data yang lama akan menjadi history
		</p>
		</i>
		<br>
      	<!--  start product-table ..................................................................................... -->
        <form id="mainform" action="">
        <table border="0" width="80%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Admin</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Username</a></th>
            <!--<th class="table-header-repeat line-left minwidth-1"><a href="">Password</a></th>-->
			<?php 
			if($domain=="superadmin"){
				echo "<th class='table-header-repeat line-left minwidth-1'><a href=''>Status</a></th>";
			}
			?>
            <th class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>        
        
        <?php
		$view=mysqli_query($link,"select * from user_admin order by nama_admin asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_admin'];?></td>
            <td><?php echo $row['username'];?></td>
            <!--
            <td><?php //echo $row['password'];?></td>
			-->
			<?php 
			if($domain=="superadmin"){
				?>
			<td>
				<?php 
				
				if($row['locked']=='no'){
					?><a href="?page=data_admin&mode=change&locked=yes&id_admin=<?php echo $row['id_admin'];?>" title="Klik untuk mengubah status" onClick="return confirm('Apakah anda yakin akan ubah menjadi locked')"><font color="#0066FF"><b>Active</b></font></a><?php
				}else{
					?><a href="?page=data_admin&mode=change&locked=no&id_admin=<?php echo $row['id_admin'];?>" title="Klik untuk mengubah status" onClick="return confirm('Apakah anda yakin akan ubah menjadi Active')"><font color="#FF0000"><b>Locked</b></font></a><?php
				}
				
				?></td><?php
			}
			?>
            <td class="options-width">
            <a href="?page=data_admin&mode=delete&id_admin=<?php echo $row['id_admin'];?>&username=<?php echo $row['username'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=data_admin&mode=edit&id_admin=<?php echo $row['id_admin'];?>" title="Edit" class="icon-5 info-tooltip"></a>        
            </td>
        </tr>
		<?php
		}
		?>
        </table>
        <!--  end product-table................................... --> 
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