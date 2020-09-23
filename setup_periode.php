<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){
	$nama_semester=ucwords(htmlentities($_POST['nama_semester']));
	$tahun_ajaran=strtoupper(htmlentities($_POST['tahun_ajaran']));
	$semester=$_POST['semester'];
	$status_aktif=$_POST['status_aktif'];
		
	if($status_aktif=='yes'){
		$update=mysqli_query($link,"update setup_periode set status_aktif='no'");
	}
	
	$query=mysqli_query($link,"insert into setup_periode(nama_semester,tahun_ajaran,semester,status_aktif) values('$nama_semester','$tahun_ajaran','$semester','$status_aktif')");
	
	if($query){
		?><script language="javascript">document.location.href="?page=setup_periode&status=1";</script><?php
	}
}

if($_GET['mode']=='delete'){
	
	$id_periode=$_GET['id_periode'];
	$query=mysqli_query($link,"delete from setup_periode where id_periode='$id_periode'");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_periode&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_periode=$_POST['id_periode'];
	$nama_semester=ucwords(htmlentities($_POST['nama_semester']));
	$tahun_ajaran=strtoupper(htmlentities($_POST['tahun_ajaran']));
	$semester=$_POST['semester'];
	$status_aktif=$_POST['status_aktif'];
	
	if($status_aktif=='yes'){
		$update=mysqli_query($link,"update setup_periode set status_aktif='no'");
	}

	$query=mysqli_query($link,"update setup_periode set nama_semester='$nama_semester',tahun_ajaran='$tahun_ajaran',semester='$semester',status_aktif='$status_aktif' where id_periode='$id_periode'");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_periode&status=3";</script><?php
	}
}

if($_GET['mode']=='edit'){
	$id_periode=$_GET['id_periode'];
	$edit=mysqli_query($link,"select * from setup_periode where id_periode='$id_periode'");

	$data=mysqli_fetch_array($edit);
	$nama_semester=$data['nama_semester'];
	$tahun_ajaran=$data['tahun_ajaran'];
	$semester=$data['semester'];
	$status_aktif=$data['status_aktif'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Setup Periode Semester</h1>
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
				?><form action="?page=setup_periode&mode=update" method="post"><?php 
			}else{
				?><form action="?page=setup_periode&mode=input" method="post"><?php
			}
			?>
			
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Nama Semester </th>
                      <td>
                      <input type="text" class="inp-form" id="nama_semester" name="nama_semester" value="<?php echo $data['nama_semester'];?>"/>
                      </td>
                      <td></td>
                    </tr>
					<tr>
                      <th valign="top">Tahun Ajaran </th>
                      <td><input type="text" class="inp-form" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran'];?>"/>
                      </td>
                      <td></td>
                    </tr>
					 <tr>
                      <th valign="top">Periode</th>
                      <td>
					  <select name="semester"  class="styledselect_form_1">
                          <option value="genap" <?php if($data['semester']=='genap'){ echo "selected"; } ?>>Genap</option>
                          <option value="ganjil" <?php if($data['semester']=='ganjil'){ echo "selected"; } ?>>Ganjil</option>
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
					  		<input type="hidden" name="id_periode" value="<?php echo $_GET['id_periode'];?>">
					  		<input type="submit" name="submit" onClick="return cek_periode()" value="" class="form-submit" />
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
        <table border="0" width="65%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="7%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th width="28%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Semester</a></th>
            <th width="20%" class="table-header-repeat line-left minwidth-1"><a href="">Tahun Ajaran</a></th>
			<th width="16%" class="table-header-repeat line-left minwidth-1"><a href="">Periode</a></th>
			<th width="18%" class="table-header-repeat line-left minwidth-1"><a href="">Status Aktif</a></th>
            <th width="11%" class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
		$view=mysqli_query($link,"select * from setup_periode order by id_periode desc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_semester'];?></td>
            <td><?php echo $row['tahun_ajaran'];?></td>
			<td><?php echo ucwords($row['semester']);?></td>
			<td>
			<b>
			<?php 
			if($row['status_aktif']=='yes'){
				echo "<font color='blue'>".ucwords($row['status_aktif'])."</font>";
			}else{
				echo "<font color='red'>".ucwords($row['status_aktif'])."</font>";
			}
			?>
			</b>
			</td>
            <td class="options-width">
            <a href="?page=setup_periode&mode=delete&id_periode=<?php echo $row['id_periode'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=setup_periode&mode=edit&id_periode=<?php echo $row['id_periode'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
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