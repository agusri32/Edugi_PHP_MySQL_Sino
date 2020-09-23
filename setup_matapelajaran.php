<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){
	$id_kelompok=htmlentities($_POST['id_kelompok']);
	$nama_matapelajaran=ucwords(htmlentities($_POST['nama_matapelajaran']));
	$kode_matapelajaran=ucwords(htmlentities($_POST['kode_matapelajaran']));

	$cek=mysqli_num_rows(mysqli_query($link,"select * from setup_matapelajaran where nama_matapelajaran='$nama_matapelajaran' || kode_matapelajaran='$kode_matapelajaran'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=setup_matapelajaran&status=4";</script><?php
	}else{

		$query=mysqli_query($link,"insert into setup_matapelajaran(id_kelompok,nama_matapelajaran,kode_matapelajaran) values('$id_kelompok','$nama_matapelajaran','$kode_matapelajaran')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_matapelajaran&status=1";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){
	
	$id_matapelajaran=$_GET['id_matapelajaran'];
	$query=mysqli_query($link,"delete from setup_matapelajaran where id_matapelajaran='$id_matapelajaran'");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_matapelajaran&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_matapelajaran=$_POST['id_matapelajaran'];
	$id_kelompok=$_POST['id_kelompok'];
	$nama_matapelajaran=ucwords(htmlentities($_POST['nama_matapelajaran']));
	$kode_matapelajaran=ucwords(htmlentities($_POST['kode_matapelajaran']));
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from setup_matapelajaran where nama_matapelajaran='$nama_matapelajaran' || kode_matapelajaran='$kode_matapelajaran'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=setup_matapelajaran&status=4";</script><?php
	}else{
	
		$query=mysqli_query($link,"update setup_matapelajaran set nama_matapelajaran='$nama_matapelajaran',id_kelompok='$id_kelompok',kode_matapelajaran='$kode_matapelajaran' where id_matapelajaran='$id_matapelajaran'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_matapelajaran&status=3";</script><?php
		}
	}
}

if($_GET['mode']=='edit'){
	$id_matapelajaran=$_GET['id_matapelajaran'];
	$edit=mysqli_query($link,"select * from setup_matapelajaran where id_matapelajaran='$id_matapelajaran'");

	$data=mysqli_fetch_array($edit);
	$id_kelompok=$data['id_kelompok'];
	$nama_matapelajaran=$data['nama_matapelajaran'];
	$kode_matapelajaran=$data['kode_matapelajaran'];
	//$sks=$data['sks'];
	//$semester=$data['semester'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Setup Mata Pelajaran</h1>
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
				?><form action="?page=setup_matapelajaran&mode=update" method="post"><?php 
			}else{
				?><form action="?page=setup_matapelajaran&mode=input" method="post"><?php
			}
			?>
			
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                  	 <tr>
                      <th valign="top">Kelompok MatPel</th>
                      <td><select name="id_kelompok" class="styledselect_form_1">
                      <?php
					  $kelompok=mysqli_query($link,"select * from setup_kelompok_matpel order by nama_kelompok asc");
					  while($row1=mysqli_fetch_array($kelompok)){
					  ?>
                          <option value="<?php echo $row1['id_kelompok'];?>" <?php if($row1['id_kelompok']==$id_kelompok){ echo 'selected';}?>><?php echo $row1['nama_kelompok'];?></option>
					  <?php
					  }
					  ?>                           
                        </select>
                      </td>
                      <td></td>
                    </tr>
                  
                    <tr>
                      <th valign="top">Nama Mata Pelajaran </th>
                      <td><input type="text" class="inp-form" id="nama_matapelajaran" name="nama_matapelajaran" value="<?php echo $data['nama_matapelajaran'];?>"/></td>
                      <td></td>
                    </tr>
					<tr>
                      <th valign="top">Kode Mata Pelajaran </th>
                      <td><input type="text" class="inp-form" id="nama_matapelajaran" name="kode_matapelajaran" value="<?php echo $data['kode_matapelajaran'];?>"/></td>
                      <td></td>
                    </tr>
					<!--
					<tr>
                      <th valign="top">SKS </th>
                      <td><input type="text" class="inp-form" id="nama_matapelajaran" name="sks" value="<?php //echo $data['sks'];?>"/></td>
                      <td></td>
                    </tr>
					<tr>
                      <th valign="top">Semester </th>
                      <td><input type="text" class="inp-form" id="nama_matapelajaran" name="semester" value="<?php //echo $data['semester'];?>"/></td>
                      <td></td>
                    </tr>
					-->
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_matapelajaran" value="<?php echo $_GET['id_matapelajaran'];?>">
					  		<input type="submit" name="submit" onClick="return cek_matapelajaran()" value="" class="form-submit" />
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
		<p> * Data di setup tidak disarankan untuk dihapus jika sistem sudah berjalan. 
		<br>* Disarankan hanya untuk update atau insert. 
		<br>* Karena Data yang lama akan menjadi history
		</p>
		</i>
		<br>
		

		<?php
		//************awal paging************//
		$query=mysqli_query($link,"select * from setup_matapelajaran order by nama_matapelajaran asc");
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
			<a href="?page=setup_matapelajaran&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
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
		$result=mysqli_query($link,"select * from setup_matapelajaran order by nama_matapelajaran asc limit $offset,$entries"); //output
		?>

      	<!--  start product-table ..................................................................................... -->
        <form id="mainform" action="">
        <table border="0" width="80%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Kelompok</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Mata Pelajaran</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Kode Mata Pelajaran</a></th>
			<!--
			<th class="table-header-repeat line-left minwidth-1"><a href="">SKS</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Semester</a></th>
			-->
            <th class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php		
		$no=0;
		while($row=mysqli_fetch_array($result)){
		?>	
		<tr>
            <td><?php echo $offset=$offset+1;?></td>
            <td><?php 
			$id_kel=$row['id_kelompok'];
			$dat=mysqli_fetch_array(mysqli_query($link,"select * from setup_kelompok_matpel where id_kelompok='$id_kel'"));
			echo $dat['nama_kelompok'];
			?></td>
            <td><?php echo $row['nama_matapelajaran'];?></td>
			<td><?php echo $row['kode_matapelajaran'];?></td>
			<!--
			<td><?php //echo $row['sks'];?></td>
			<td><?php //echo $row['semester'];?></td>
			-->
            <td class="options-width">
            <a href="?page=setup_matapelajaran&mode=delete&id_matapelajaran=<?php echo $row['id_matapelajaran'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=setup_matapelajaran&mode=edit&id_matapelajaran=<?php echo $row['id_matapelajaran'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
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
