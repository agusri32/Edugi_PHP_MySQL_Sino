<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){

	$id_siswa=htmlentities($_POST['id_siswa']);
	$id_kelas=htmlentities($_POST['id_kelas']);
	
	$cek_query=mysqli_query($link,"select * from tbl_ruangan where id_siswa='$id_siswa' and id_kelas='$id_kelas'");
	$cek_query2=mysqli_query($link,"select * from tbl_ruangan where id_siswa='$id_siswa'");
	$cek_num=mysqli_num_rows($cek_query);
	$cek_num2=mysqli_num_rows($cek_query2);
	
	if($cek_num!==0 || $cek_num2!==0){	
		?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=4";</script><?php
	}else{
		$query=mysqli_query($link,"insert into tbl_ruangan values('','$id_siswa','$id_kelas')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=1";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){
	
	$id_ruangan=$_GET['id_ruangan'];
	$query=mysqli_query($link,"delete from tbl_ruangan where id_ruangan='$id_ruangan'");
	if($query){
		?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_ruangan=$_POST['id_ruangan'];
	
	$id_siswa=$_POST['id_siswa'];
	$id_kelas=$_POST['id_kelas'];
	
	$cek_query=mysqli_query($link,"select * from tbl_ruangan where id_siswa='$id_siswa' and id_kelas='$id_kelas'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){
		?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=0";</script><?php
	}else{	
	
		$query=mysqli_query($link,"update tbl_ruangan set id_siswa='$id_siswa', id_kelas='$id_kelas' where id_ruangan='$id_ruangan'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=3";</script><?php
		}else{
			echo mysqli_error();
		}
	}
}

if($_GET['mode']=='edit'){
	$id_ruangan=$_GET['id_ruangan'];
	$edit=mysqli_query($link,"select * from tbl_ruangan where id_ruangan='$id_ruangan'");

	$data=mysqli_fetch_array($edit);
	$id_siswa=$data['id_siswa'];
	$id_kelas=$data['id_kelas'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Pengaturan Kelas Siswa</h1>
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
				?><form action="?page=jadwal_ruangkelas&mode=update" method="post"><?php 
			}else{
				?><form action="?page=jadwal_ruangkelas&mode=input" method="post"><?php
			}
			?>

 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Siswa</th>
                      <td><select name="id_siswa" >
                      <?php
					  $siswa=mysqli_query($link,"select * from data_siswa order by nama_siswa asc");
					  while($row1=mysqli_fetch_array($siswa)){
					  ?>
                          <option value="<?php echo $row1['id_siswa'];?>" <?php if($row1['id_siswa']==$id_siswa){ echo 'selected';}?>><?php echo $row1['nama_siswa'];?> (<?php echo $row1['nis'];?>) </option>
					  <?php
					  }
					  ?>                          
                          
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    
                    <tr>
                      <th valign="top">Kelas</th>
                      <td><select name="id_kelas" >
                          <?php
						  $kelas=mysqli_query($link,"select * from setup_kelas order by nama_kelas asc");
						  while($row2=mysqli_fetch_array($kelas)){
						  ?>
							  <option value="<?php echo $row2['id_kelas'];?>" <?php if($row2['id_kelas']==$id_kelas){ echo 'selected';}?>><?php echo $row2['nama_kelas'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_ruangan" value="<?php echo $_GET['id_ruangan'];?>">
					  		<input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="" class="form-submit" />
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

		    <p><em>* Satu siswa hanya untuk Satu Ruang Kelas</em>
              <!--  start product-table ..................................................................................... -->
        </p>
		<p>&nbsp;</p>
		
		
		<?php
		//************awal paging************//
		$query=mysqli_query($link,"select * from tbl_ruangan ruangan, setup_kelas kelas, data_siswa siswa where ruangan.id_kelas=kelas.id_kelas and ruangan.id_siswa=siswa.id_siswa order by id_ruangan asc");
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
			<a href="?page=jadwal_ruangkelas&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
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
		$result=mysqli_query($link,"select * from tbl_ruangan ruangan, setup_kelas kelas, data_siswa siswa where ruangan.id_kelas=kelas.id_kelas and ruangan.id_siswa=siswa.id_siswa order by id_ruangan asc limit $offset,$entries"); //output
		?>

	    <form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="13%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
            <th width="26%" class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
            <th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
            <th width="13%" class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
		$no=0;
		while($row=mysqli_fetch_array($result)){
		?>	
		<tr>
            <td><?php echo $offset=$offset+1;?></td>
            <td><?php echo $row['nama_siswa'];?></td>
            <td><?php echo $row['nis'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td class="options-width">
            <a href="?page=jadwal_ruangkelas&mode=delete&id_ruangan=<?php echo $row['id_ruangan'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=jadwal_ruangkelas&mode=edit&id_ruangan=<?php echo $row['id_ruangan'];?>" title="Edit" class="icon-5 info-tooltip"></a>                    
            </td>
        </tr>
		<?php
		}
		?>
        </table>
		TOTAL DATA : <?php echo $get_pages;?>
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