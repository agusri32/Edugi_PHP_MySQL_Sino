<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if($_GET['mode']=='input'){	
	$nama_guru=ucwords(htmlentities($_POST['nama_guru']));
	$nip=htmlentities($_POST['nip']);
	$kelamin=htmlentities($_POST['kelamin']);
	$alamat_guru=ucwords(htmlentities($_POST['alamat_guru']));
	$telpon_guru=strtoupper(htmlentities($_POST['telpon_guru']));
	$username=htmlentities($_POST['username']);
	$password=md5(htmlentities($_POST['password']));
		
	$gelar=htmlentities($_POST['gelar']);
	$tempat_lahir=htmlentities($_POST['tempat_lahir']);
	$tanggal_lahir=htmlentities($_POST['tanggal_lahir']);
	$agama=htmlentities($_POST['agama']);
	$email=htmlentities($_POST['email']);
	
	$nama_photo=$_FILES['photo']['name'];
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=data_guru&status=5";</script><?php
	}else{
		$uploaddir='./photo_guru/';
		$rnd=date(His);				
		$nama_file_upload=$rnd.'-'.$nama_photo;
		$alamatfile=$uploaddir.$nama_file_upload;
		
		if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
		{
			
			$$query=mysqli_query($link,"insert into data_guru(nama_guru,nip,kelamin,alamat_guru,telpon_guru,username,password,locked,gelar,tempat_lahir,tanggal_lahir,agama,email,photo) values('$nama_guru','$nip','$kelamin','$alamat_guru','$telpon_guru','$username','$password','no','$gelar','$tempat_lahir','$tanggal_lahir','$agama','$email','$nama_file_upload')");
			
			//untuk insert ke user_pesan
			insert_user($username,$nama_guru,'guru');
			
			if($query){
				?><script language="javascript">document.location.href="?page=data_guru&status=1";</script><?php
			}else{
				?><script language="javascript">document.location.href="?page=data_guru&status=0";</script><?php
			}

		}else{
			?><script language="javascript">document.location.href="?page=data_guru&status=8";</script><?php
		}
	}
}


if($_GET['mode']=='delete'){
	$username=$_GET['username'];
	$id_guru=$_GET['id_guru'];
	
	$data=mysqli_fetch_array(mysqli_query($link,"select photo from data_guru where id_guru='$id_guru'"));
	$photo=$data['photo'];
	
	//user pesan
	delete_user($username);
	unlink("./photo_guru/".$photo);
	
	$query=mysqli_query($link,"delete from data_guru where id_guru='$id_guru'");
		
	if($query){
		?><script language="javascript">document.location.href="?page=data_guru&status=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_guru&status=0";</script><?php
	}
}

if($_GET['mode']=='change'){
	
	$locked=$_GET['locked'];
	$id_guru=$_GET['id_guru'];
	
	$query=mysqli_query($link,"UPDATE data_guru SET `locked` = '$locked' WHERE `id_guru`= '$id_guru'");
	if($query){
		?><script language="javascript">document.location.href="?page=data_guru&status=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_guru&status=0";</script><?php
	}
}


if($_GET['mode']=='update'){
	$id_guru=$_POST['id_guru'];
	$nama_guru=ucwords($_POST['nama_guru']);
	$nip=$_POST['nip'];
	$kelamin=$_POST['kelamin'];
	$alamat_guru=$_POST['alamat_guru'];
	$telpon_guru=$_POST['telpon_guru'];
	$username=$_POST['username'];
	
	$username_lama=$_POST['username_lama'];
	$password_lama=$_POST['password_lama'];
	
	$gelar=htmlentities($_POST['gelar']);
	$tempat_lahir=htmlentities($_POST['tempat_lahir']);
	$tanggal_lahir=htmlentities($_POST['tanggal_lahir']);
	$agama=htmlentities($_POST['agama']);
	$email=htmlentities($_POST['email']);
	
	$photo_lama=$_POST['photo_lama'];
	$nama_photo=$_FILES['photo']['name'];
	
	if(empty($_POST['password'])){
		$password=$password_lama;
	}else{
		$password=md5($_POST['password']);
	}
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username' && username<>'$username_lama'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=data_guru&status=5";</script><?php
	}else{
		
		if(empty($_FILES['photo']['name'])){
			$nama_file_upload=$photo_lama;			
			$query=mysqli_query($link,"update data_guru set nama_guru='$nama_guru', nip='$nip', kelamin='$kelamin', alamat_guru='$alamat_guru', telpon_guru='$telpon_guru',
								username='$username', password='$password', gelar='$gelar',tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir', agama='$agama',email='$email',photo='$nama_file_upload' where id_guru='$id_guru'");
			
			update_user($username,$username_lama,$nama_guru,'guru');
			
		}else{
			$uploaddir='./photo_guru/';
			$rnd=date(His);				
			$nama_file_upload=$rnd.'-'.$nama_photo;
			$alamatfile=$uploaddir.$nama_file_upload;
			
			if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
			{
				$query=mysqli_query($link,"update data_guru set nama_guru='$nama_guru', nip='$nip', kelamin='$kelamin', alamat_guru='$alamat_guru', telpon_guru='$telpon_guru',
									username='$username', password='$password', gelar='$gelar',tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir', agama='$agama',email='$email',photo='$nama_file_upload' where id_guru='$id_guru'");
				
				unlink("./photo_guru/".$photo_lama);
				update_user($username,$username_lama,$nama_guru,'guru');
			
			}else{
				?><script language="javascript">document.location.href="?page=data_guru&status=8";</script><?php
			}
		}

		if($query){
			?><script language="javascript">document.location.href="?page=data_guru&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_guru&status=0";</script><?php
		}
	}
}

if($_GET['mode']=='edit'){
	$id_guru=$_GET['id_guru'];
	$edit=mysqli_query($link,"select * from data_guru where id_guru='$id_guru'");

	$data=mysqli_fetch_array($edit);
	$nama_guru=$data['nama_guru'];
	$nip=$data['nip'];
	$kelamin=$data['kelamin'];
	$alamat_guru=$data['alamat_guru'];
	$telpon_guru=$data['telpon_guru'];
	$username=$data['username'];
	
	$username_lama=$data['username'];
	$password_lama=$data['password'];
	
	$gelar=$data['gelar'];
	$tempat_lahir=$data['tempat_lahir'];
	$tanggal_lahir=$data['tanggal_lahir'];
	$agama=$data['agama'];
	$email=$data['email'];
	$photo=$data['photo'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Data Guru</h1>
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
				?><form action="?page=data_guru&mode=update" enctype="multipart/form-data" method="post" name="postform"><?php 
			}else{
				?><form action="?page=data_guru&mode=input" enctype="multipart/form-data" method="post" name="postform"><?php
			}
			?>
 	        <table border="0" width="70%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Nama Guru </th>
                      <td><input type="text" class="inp-form" id="nama_guru" name="nama_guru" value="<?php echo $nama_guru; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                       <th valign="top">NIP</th>
                      <td><input type="text" class="inp-form" id="nip" name="nip" value="<?php echo $nip; ?>"/></td>
                      <td></td>
                    </tr>
					<tr>
					  <th valign="top">Gelar </th>
                      <td><input type="text" class="inp-form" id="gelar" name="gelar" value="<?php echo $gelar; ?>"/></td>
                      <td></td>
                    </tr>
					<tr>
					  <th valign="top">Tempat Lahir </th>
                      <td><input type="text" class="inp-form" id="tempat_lahir" name="tempat_lahir" value="<?php echo $tempat_lahir; ?>"/></td>
                      <td></td>
                    </tr>
					<tr>
					  <th valign="top">Tanggal Lahir </th>
					  <td>
					  <input type="text" name="tanggal_lahir" class="inp-form" value="<?php echo $tanggal_lahir; ?>">
                      <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>		              </td>
					  <td></td>
					</tr>
					<tr>
					  <th valign="top">Agama</th>
                      <td><select name="agama"  class="styledselect_form_1">
                          <option value="islam" <?php if($data['agama']=='islam'){ echo "selected"; } ?>>Islam</option>
                          <option value="kristen" <?php if($data['agama']=='kristen'){ echo "selected"; } ?>>Kristen</option>
						  <option value="katolik" <?php if($data['agama']=='katolik'){ echo "selected"; } ?>>Katolik</option>
                          <option value="budha" <?php if($data['agama']=='budha'){ echo "selected"; } ?>>Budha</option>
                          <option value="konghuchu" <?php if($data['agama']=='konghuchu'){ echo "selected"; } ?>>Konghuchu</option>
                        </select>                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">Kelamin</th>
                      <td><select name="kelamin"  class="styledselect_form_1">
                          <option value="laki-laki" <?php if($data['kelamin']=='laki-laki'){ echo "selected"; } ?>>Laki-laki</option>
                          <option value="perempuan" <?php if($data['kelamin']=='perempuan'){ echo "selected"; } ?>>Perempuan</option>
                        </select>                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">Alamat</th>
                      <td><textarea id="alamat_guru" name="alamat_guru" cols="" rows="" class="form-textarea"><?php echo $alamat_guru; ?></textarea></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">Telpon </th>
                      <td><input type="text" class="inp-form" id="telpon_guru" name="telpon_guru" value="<?php echo $telpon_guru; ?>"/></td>
                      <td></td>
                    </tr>
					<tr>
					  <th valign="top">Email </th>
                      <td><input type="text" class="inp-form" id="email" name="email" value="<?php echo $email; ?>"/></td>
                      <td></td>
                    </tr>
					<tr>
					  <th></th>
						<th>
						<?php 
						if(empty($photo)){
							$photo_guru='nopic.jpg';
						}else{
							$photo_guru=$photo;
						}
						?>
						<img src="./photo_guru/<?php echo $photo_guru;?>" height="101" width="83">						</th>
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
                      <td><input type="password" class="inp-form" id="password" name="password" value="<?php echo $password; ?>"/> *Kosogkan jika tidak diubah</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_guru" value="<?php echo $_GET['id_guru'];?>">
							<input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
							<input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
							<input type="hidden" name="photo_lama" value="<?php echo $photo;?>">
					  		<input type="submit" name="submit" onClick="return cek_guru()" value="" class="form-submit" />
                          	<input type="reset" value="" class="form-reset"  />                      </td>
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
		<?php
		//************awal paging************//
		$query=mysqli_query($link,"select * from data_guru order by nama_guru asc");
		$get_pages=mysqli_num_rows($query); //dapatkan jumlah semua data
		
		if ($get_pages>$entries)  //jika jumlah semua data lebih banyak dari nilai awal yang diberikan
		{
			?>Halaman : <?php
			$pages=1;
			while($pages<=ceil($get_pages/$entries))
			{
				if ($pages!=1)
				{
					echo " | ";
				}
			?>
			<!--Membuat link sesuai nama halaman-->
			<a href="?page=data_guru&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
			<?php
			$pages++;
			}
			
		}else{
			$pages=1;
		}
		
		//**************akhir paging*****************//
		?>
		</font>
		<?php
		$page=(int)$_GET['halaman'];
		$offset=$page*$entries;
		
		//menampilkan data dengan menggunakan limit sesuai parameter paging yang diberikan
		$result=mysqli_query($link,"select * from data_guru order by nama_guru asc limit $offset,$entries"); //output
		?>
		</center>
		
		<center>
		<a href="javascript:;"><img src="./images/excel-icon.jpeg" title="Export Data" width="18" height="18" border="0" onClick="window.open('./excel/export_data_guru.php','scrollwindow','top=200,left=300,width=800,height=500');"></a>
		</center>

		
		<form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="5%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
			<th width="16%" class="table-header-repeat line-left minwidth-1"><a href="">Photo</a></th>
            <th width="9%" class="table-header-repeat line-left minwidth-1"><a href="">Nama_Guru</a></th>
            <th width="3%" class="table-header-repeat line-left minwidth-1"><a href="">NIP</a></th>
            <th width="6%" class="table-header-repeat line-left minwidth-1"><a href="">Kelamin</a></th>
            <th width="5%" class="table-header-repeat line-left minwidth-1"><a href="">Alamat</a></th>
            <th width="5%" class="table-header-repeat line-left minwidth-1"><a href="">Telpon</a></th>
            <th width="8%" class="table-header-repeat line-left minwidth-1"><a href="">Username</a></th>
            <!--
            <th width="7%" class="table-header-repeat line-left minwidth-1"><a href="">Password</a></th>
			-->
			<th width="4%" class="table-header-repeat line-left minwidth-1"><a href="">Gelar</a></th>
            <th width="11%" class="table-header-repeat line-left minwidth-1"><a href="">Tempat_Lahir</a></th>
            <th width="11%" class="table-header-repeat line-left minwidth-1"><a href="">Tanggal_Lahir</a></th>
            <th width="5%" class="table-header-repeat line-left minwidth-1"><a href="">Agama</a></th>
			<th width="4%" class="table-header-repeat line-left minwidth-1"><a href="">Email</a></th>
			<?php 
			if($domain=="superadmin"){
				echo "<th class='table-header-repeat line-left minwidth-1'><a href=''>Status</a></th>";
			}
			?>
            <th width="6%" class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>   
        <?php
		$no=0;
		while($row=mysqli_fetch_array($result)){
		?>	
		<tr>
            <td><?php echo $offset=$offset+1;?></td>
			<td>
			<?php 
			if(empty($row['photo'])){
				$photo_guru='nopic.jpg';
			}else{
				$photo_guru=$row['photo'];
			}
			?>
			<img src="./photo_guru/<?php echo $photo_guru;?>" height="107" width="83" align="middle">
			</td>
            <td><?php echo $row['nama_guru'];?></td>
            <td><?php echo $row['nip'];?></td>
            <td><?php echo ucwords($row['kelamin']);?></td>
            <td><?php echo $row['alamat_guru'];?></td>
            <td><?php echo $row['telpon_guru'];?></td>
            <td><?php echo $row['username'];?></td>
            <!--
            <td><?php //echo $row['password'];?></td>
			-->
			<td><?php echo $row['gelar'];?></td>
            <td><?php echo $row['tempat_lahir'];?></td>
            <td><?php echo $row['tanggal_lahir'];?></td>
            <td><?php echo $row['agama'];?></td>
			<td><?php echo $row['email'];?></td>
			<?php 
			if($domain=="superadmin"){
				?>
			<td>
				<?php 
				
				if($row['locked']=='no'){
					?><a href="?page=data_guru&mode=change&locked=yes&id_guru=<?php echo $row['id_guru'];?>" title="Klik untuk mengubah status" onClick="return confirm('Apakah anda yakin akan ubah menjadi locked')"><font color="#0066FF"><b>Active</b></font></a><?php
				}else{
					?><a href="?page=data_guru&mode=change&locked=no&id_guru=<?php echo $row['id_guru'];?>" title="Klik untuk mengubah status" onClick="return confirm('Apakah anda yakin akan ubah menjadi Active')"><font color="#FF0000"><b>Locked</b></font></a><?php
				}
				
				?></td><?php
			}
			?>
            <td width="0%" class="options-width">
            <a href="?page=data_guru&mode=delete&id_guru=<?php echo $row['id_guru'];?>&username=<?php echo $row['username'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=data_guru&mode=edit&id_guru=<?php echo $row['id_guru'];?>" title="Edit" class="icon-5 info-tooltip"></a>        
            </td>
        </tr>
		<?php
		}
		?>
        </table>
        <!--  end product-table................................... --> 
		<center>TOTAL DATA : <?php echo $get_pages;?></center>
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
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>