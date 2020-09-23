<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){
	
	$judul=ucwords(htmlentities($_POST['judul']));
	$isi=ucwords(htmlentities($_POST['isi']));
	$untuk=htmlentities($_POST['untuk']);
	$status_aktif=strtoupper(htmlentities($_POST['status_aktif']));
	
	$query=mysqli_query($link,"insert into setup_pengumuman values('','$judul','$isi','$untuk','$status_aktif')");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_pengumuman&status=1";</script><?php
	}
	
}

if($_GET['mode']=='delete'){
	
	$id_pengumuman=$_GET['id_pengumuman'];
	$query=mysqli_query($link,"delete from setup_pengumuman where id_pengumuman='$id_pengumuman'");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_pengumuman&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_pengumuman=$_POST['id_pengumuman'];
	$judul=ucwords(htmlentities($_POST['judul']));
	$untuk=htmlentities($_POST['untuk']);
	$isi=ucwords(htmlentities($_POST['isi']));
	$status_aktif=$_POST['status_aktif'];
	
	//boleh lebih dari satu pengumuman yang aktif
	$query=mysqli_query($link,"update setup_pengumuman set judul='$judul',isi='$isi', untuk='$untuk', status_aktif='$status_aktif' where id_pengumuman='$id_pengumuman'");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_pengumuman&status=3";</script><?php
	}
	
}

if($_GET['mode']=='edit'){
	$id_pengumuman=$_GET['id_pengumuman'];
	$edit=mysqli_query($link,"select * from setup_pengumuman where id_pengumuman='$id_pengumuman'");

	$data=mysqli_fetch_array($edit);
	$judul=$data['judul'];
	$isi=$data['isi'];
	$untuk=$data['untuk'];
	$status_aktif=$data['status_aktif'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Pengumuman </h1>
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
	
			<?php
			if($_GET['mode']=='edit'){
				?><form action="?page=setup_pengumuman&mode=update" method="post"><?php 
			}else{
				?><form action="?page=setup_pengumuman&mode=input" method="post"><?php
			}
			?>
			
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Judul </th>
                      <td><input type="text" class="inp-form" id="judul" name="judul" value="<?php echo $data['judul'];?>"/></td>
                      <td></td>
                    </tr>
					 <tr>
                      <th valign="top">Isi Pengumuman</th>
                      <td>
					  <textarea cols="25" name="isi" id="isi" rows="5"><?php echo $data['isi'];?></textarea>
					  </td>
                      <td></td>
                    </tr>
					
					 <tr>
                      <th valign="top">Untuk </th>
                      <td>
					  <select name="untuk"  class="styledselect_form_1">
                          <option value="umum" <?php  if($data['untuk']=='umum'){ echo "selected"; } ?>>Umum</option>
                          <option value="guru" <?php  if($data['untuk']=='guru'){ echo "selected"; } ?>>Guru</option>
						  <option value="siswa" <?php if($data['untuk']=='siswa'){ echo "selected"; } ?>>Siswa</option>
						  <option value="orangtua" <?php  if($data['untuk']=='orangtua'){ echo "selected"; } ?>>Orangtua</option>
                      </select>
					  </td>
                      <td></td>
                    </tr>

					 <tr>
                      <th valign="top">Status Aktif </th>
                      <td>
					  <select name="status_aktif"  class="styledselect_form_1">
                          <option value="yes" <?php if($data['status_aktif']=='yes'){ echo "selected"; } ?>>Yes</option>
                          <option value="no" <?php if($data['status_aktif']=='no'){ echo "selected"; } ?>>No</option>
                      </select>
					  </td>
                      <td></td>
                    </tr>
					
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_pengumuman" value="<?php echo $_GET['id_pengumuman'];?>">
					  		<input type="submit" name="submit" onClick="return cek_pengumuman()" value="" class="form-submit" />
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
		<p> * Hanya boleh satu periode yang aktif </p>
		<p> * Data di setup tidak disarankan untuk dihapus jika sistem sudah berjalan. 
		<br>* Disarankan hanya untuk update atau insert. 
		<br>* Karena Data yang lama akan menjadi history
		</p>
		</i>
		<br>
      	<!--  start product-table ..................................................................................... -->
        <form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="6%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th width="17%" class="table-header-repeat line-left minwidth-1"><a href="">Judul</a></th>
			<th width="49%" class="table-header-repeat line-left minwidth-1"><a href="">Isi Pengumuman</a></th>
			<th width="9%" class="table-header-repeat line-left minwidth-1"><a href="">Untuk</a></th>
			<th width="14%" class="table-header-repeat line-left minwidth-1"><a href="">Status Aktif</a></th>
            <th width="7%" class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
		$view=mysqli_query($link,"select * from setup_pengumuman order by id_pengumuman asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['judul'];?></td>
			<td><?php echo $row['isi'];?></td>
			<td><?php echo ucwords($row['untuk']);?></td>
			<td align="center">
			<?php 
			if($row['status_aktif']=='yes'){
				echo "<b><font color='blue'>".ucwords($row['status_aktif'])."</b></font>";
			}else{
				echo "<b><font color='red'>".ucwords($row['status_aktif'])."</b></font>";
			}
			
			?></td>
            <td class="options-width">
            <a href="?page=setup_pengumuman&mode=delete&id_pengumuman=<?php echo $row['id_pengumuman'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=setup_pengumuman&mode=edit&id_pengumuman=<?php echo $row['id_pengumuman'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
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