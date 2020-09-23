<?php
/* Update
19-08-2014 : penambahan field pekerjaan
*/
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){	
	$nama_orangtua=ucwords(htmlentities($_POST['nama_orangtua']));
	$kelamin=htmlentities($_POST['kelamin']);
	$status_keluarga=htmlentities($_POST['status_keluarga']);
	$pekerjaan=htmlentities($_POST['pekerjaan']);
	$alamat_orangtua=ucwords(htmlentities($_POST['alamat_orangtua']));
	$telpon_orangtua=strtoupper(htmlentities($_POST['telpon_orangtua']));
	$username=htmlentities($_POST['username']);
	$password=md5(htmlentities($_POST['password']));
	
	$nama_photo=$_FILES['photo']['name'];
		
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=data_ortu&status=4";</script><?php
	}else{
		$uploaddir='./photo_ortu/';
		$rnd=date(His);				
		$nama_file_upload=$rnd.'-'.$nama_photo;
		$alamatfile=$uploaddir.$nama_file_upload;
		
		if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
		{
			$query=mysqli_query($link,"insert into data_orangtua(nama_orangtua,kelamin,status_keluarga,pekerjaan,alamat_orangtua,telpon_orangtua,username,password,photo) values('$nama_orangtua','$kelamin','$status_keluarga','$pekerjaan','$alamat_orangtua','$telpon_orangtua','$username','$password','$nama_file_upload')");
			insert_user($username,$nama_orangtua,'orangtua');
			
			if($query){
				?><script language="javascript">document.location.href="?page=data_ortu&status=1";</script><?php
			}else{
				?><script language="javascript">document.location.href="?page=data_ortu&status=0";</script><?php
			}
			
		}else{
			?><script language="javascript">document.location.href="?page=data_ortu&status=8";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){
	$username=$_GET['username'];
	$id_orangtua=$_GET['id_orangtua'];
	
	$data=mysqli_fetch_array(mysqli_query($link,"select photo from data_guru where id_guru='$id_guru'"));
	$photo=$data['photo'];
	
	delete_user($username);
	unlink("./photo_ortu/".$photo);
	
	$query=mysqli_query($link,"delete from data_orangtua where id_orangtua='$id_orangtua'");
	if($query){
		?><script language="javascript">document.location.href="?page=data_ortu&status=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_ortu&status=1";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_orangtua=$_POST['id_orangtua'];
	$nama_orangtua=$_POST['nama_orangtua'];
	$kelamin=$_POST['kelamin'];
	$status_keluarga=$_POST['status_keluarga'];
	$pekerjaan=$_POST['pekerjaan'];
	$alamat_orangtua=$_POST['alamat_orangtua'];
	$telpon_orangtua=$_POST['telpon_orangtua'];
	$username=$_POST['username'];
	
	$username_lama=$_POST['username_lama'];
	$password_lama=$_POST['password_lama'];
	
	$photo_lama=$_POST['photo_lama'];
	$nama_photo=$_FILES['photo']['name'];
	
	if(empty($_POST['password'])){
		$password=$password_lama;
	}else{
		$password=md5($_POST['password']);
	}
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username' && username<>'$username_lama'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=data_ortu&status=4";</script><?php
	}else{
		
		if(empty($_FILES['photo']['name'])){
			$nama_file_upload=$photo_lama;
			$query=mysqli_query($link,"update data_orangtua set nama_orangtua='$nama_orangtua', status_keluarga='$status_keluarga', kelamin='$kelamin', alamat_orangtua='$alamat_orangtua', telpon_orangtua='$telpon_orangtua', username='$username', password='$password',photo='$nama_file_upload',pekerjaan='$pekerjaan' where id_orangtua='$id_orangtua'");
			
			update_user($username,$username_lama,$nama_orangtua,'orangtua');
		}else{
			$uploaddir='./photo_ortu/';
			$rnd=date(His);				
			$nama_file_upload=$rnd.'-'.$nama_photo;
			$alamatfile=$uploaddir.$nama_file_upload;
			
			if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
			{
				$query=mysqli_query($link,"update data_orangtua set nama_orangtua='$nama_orangtua', status_keluarga='$status_keluarga', kelamin='$kelamin', alamat_orangtua='$alamat_orangtua', telpon_orangtua='$telpon_orangtua', username='$username', password='$password',photo='$nama_file_upload',pekerjaan='$pekerjaan' where id_orangtua='$id_orangtua'");
								
				update_user($username,$username_lama,$nama_orangtua,'orangtua');
			}else{
				?><script language="javascript">document.location.href="?page=data_ortu&status=8";</script><?php
			}
		}
			
		if($query){
			?><script language="javascript">document.location.href="?page=data_ortu&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_ortu&status=0";</script><?php
		}			
	}
}

if($_GET['mode']=='edit'){
	$id_orangtua=$_GET['id_orangtua'];
	$edit=mysqli_query($link,"select * from data_orangtua where id_orangtua='$id_orangtua'");

	$data=mysqli_fetch_array($edit);
	$nama_orangtua=$data['nama_orangtua'];
	$kelamin=$data['kelamin'];
	$status_keluarga=$data['status_keluarga'];
	$pekerjaan=$data['pekerjaan'];
	$alamat_orangtua=$data['alamat_orangtua'];
	$telpon_orangtua=$data['telpon_orangtua'];
	$username=$data['username'];
	
	$username_lama=$data['username'];
	$password_lama=$data['password'];
	$photo=$data['photo'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Data Orang Tua</h1>
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
				?><form action="?page=data_ortu&mode=update" enctype="multipart/form-data" method="post" name="postform"><?php 
			}else{
				?><form action="?page=data_ortu&mode=input" enctype="multipart/form-data" method="post" name="postform"><?php
			}
			?>
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Nama Orang Tua </th>
                      <td><input type="text" class="inp-form" id="nama_orangtua" name="nama_orangtua" value="<?php echo $nama_orangtua; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">Kelamin</th>
                      <td><select name="kelamin"  class="styledselect_form_1">
                          <option value="laki-laki" <?php if($kelamin=='laki-laki'){ echo "selected"; } ?>>Laki-laki</option>
                          <option value="perempuan" <?php if($kelamin=='perempuan'){ echo "selected"; } ?>>Perempuan</option>
                        </select>
                      </td>
                      <td></td>
                    </tr>
					<tr>
                      <th valign="top">Status Keluarga</th>
                      <td><select name="status_keluarga"  class="styledselect_form_1">
                          <option value="bapak" <?php if($status_keluarga=='bapak'){ echo "selected"; } ?>>Bapak</option>
						  <option value="ibu" <?php if($status_keluarga=='ibu'){ echo "selected"; } ?>>Ibu</option>
                          <option value="wali" <?php if($status_keluarga=='wali'){ echo "selected"; } ?>>Wali</option>
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">Pekerjaan</th>
                      <td><input type="text" class="inp-form" id="pekerjaan" name="pekerjaan" value="<?php echo $pekerjaan; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">Alamat</th>
                      <td><textarea id="alamat_orangtua" name="alamat_orangtua" cols="" rows="" class="form-textarea"><?php echo $alamat_orangtua; ?></textarea></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Telpon </th>
                      <td><input type="text" class="inp-form" id="telpon_orangtua" name="telpon_orangtua" value="<?php echo $telpon_orangtua; ?>"/></td>
                      <td></td>
                    </tr>
					<tr>
						<th></th>
						<th>
						<?php 
						if(empty($photo)){
							$photo_ortu='nopic.jpg';
						}else{
							$photo_ortu=$photo;
						}
						?>
						<img src="./photo_ortu/<?php echo $photo_ortu;?>" height="101" width="83">
						</th>
					</tr>
					<tr>
					  <th>Photo</th>
					  <td>
					    <input type="file" name="photo" size="30"/></td>
					  <td></td>
					</tr>
                     <tr>
                      <th valign="top">Username</th>
                      <td><input type="text" class="inp-form" id="username" name="username" value="<?php echo $username; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Password</th>
                      <td><input type="password" class="inp-form" id="password" name="password"/> *Kosogkan jika tidak diubah</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_orangtua" value="<?php echo $_GET['id_orangtua'];?>">
							<input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
							<input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
							<input type="hidden" name="photo_lama" value="<?php echo $photo;?>">
					  		<input type="submit" name="submit" onClick="return cek_ortu()" value="" class="form-submit" />
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
		
		
		<center>
		<a href="javascript:;"><img src="./images/excel-icon.jpeg" title="Export Data" width="18" height="18" border="0" onClick="window.open('./excel/export_data_orang_tua.php','scrollwindow','top=200,left=300,width=800,height=500');"></a>
		</center>

		
        <form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="6%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
			<th width="16%" class="table-header-repeat line-left minwidth-1"><a href="">Photo</a></th>
            <th width="18%" class="table-header-repeat line-left minwidth-1"><a href="">Nama_Orangtua</a></th>
            <th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">Status</a></th>
            <th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">Pekerjaan</a></th>
            <th width="11%" class="table-header-repeat line-left minwidth-1"><a href="">Kelamin</a></th>
            <th width="23%" class="table-header-repeat line-left minwidth-1"><a href="">Alamat</a></th>
            <th width="11%" class="table-header-repeat line-left minwidth-1"><a href="">Telpon</a></th>
            <th width="9%" class="table-header-repeat line-left minwidth-1"><a href="">Username</a></th>
			<!--<th width="9%" class="table-header-repeat line-left minwidth-1"><a href="">Password</a></th>-->
            <th width="7%" class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
		$view=mysqli_query($link,"select * from data_orangtua order by nama_orangtua asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
			<td>
			<?php 
			if(empty($row['photo'])){
				$photo_ortu='nopic.jpg';
			}else{
				$photo_ortu=$row['photo'];
			}
			?>
			<img src="./photo_ortu/<?php echo $photo_ortu;?>" height="107" width="83" align="middle">
			</td>
            <td><?php echo $row['nama_orangtua'];?></td>
            <td><?php echo ucwords($row['status_keluarga']);?></td>
            <td><?php echo ucwords($row['pekerjaan']);?></td>
            <td><?php echo ucwords($row['kelamin']);?></td>
            <td><?php echo $row['alamat_orangtua'];?></td>
            <td><?php echo $row['telpon_orangtua'];?></td>
            <td><?php echo $row['username'];?></td>
            <!--
            <td><?php //echo $row['password'];?></td>
			-->
            <td class="options-width">
            <a href="?page=data_ortu&mode=delete&id_orangtua=<?php echo $row['id_orangtua'];?>&username=<?php echo $row['username'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=data_ortu&mode=edit&id_orangtua=<?php echo $row['id_orangtua'];?>" title="Edit" class="icon-5 info-tooltip"></a>        
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