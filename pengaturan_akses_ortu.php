<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){
	$id_ortu=htmlentities($_POST['id_ortu']);
	$id_siswa=htmlentities($_POST['id_siswa']);
	
	$cek_query=mysqli_query($link,"select * from tbl_akses_ortu where id_orangtua='$id_ortu' and id_siswa='$id_siswa'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){	
		?><script language="javascript">document.location.href="?page=pengaturan_akses_ortu&status=4";</script><?php
	}else{
		$query=mysqli_query($link,"insert into tbl_akses_ortu values('','$id_ortu','$id_siswa')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=pengaturan_akses_ortu&status=1";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){

	$id_akses=$_GET['id_akses'];
	$query=mysqli_query($link,"delete from tbl_akses_ortu where id_akses='$id_akses'");
	if($query){
		?><script language="javascript">document.location.href="?page=pengaturan_akses_ortu&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_akses=$_POST['id_akses'];
	
	$id_ortu=htmlentities($_POST['id_ortu']);
	$id_siswa=htmlentities($_POST['id_siswa']);
	
	$cek_query=mysqli_query($link,"select * from tbl_akses_ortu where id_orangtua='$id_ortu' and id_siswa='$id_siswa'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){
		?><script language="javascript">document.location.href="?page=pengaturan_akses_ortu&status=0";</script><?php
	}else{	
	
		$query=mysqli_query($link,"update tbl_akses_ortu set id_orangtua='$id_ortu', id_siswa='$id_siswa' where id_akses='$id_akses'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=pengaturan_akses_ortu&status=3";</script><?php
		}else{
			echo mysqli_error();
		}
	}
}

if($_GET['mode']=='edit'){
	$id_akses=$_GET['id_akses'];
	$edit=mysqli_query($link,"select * from tbl_akses_ortu where id_akses='$id_akses'");

	$data=mysqli_fetch_array($edit);
	$id_ortu=$data['id_orangtua'];
	$id_siswa=$data['id_siswa'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Akses Orang Tua </h1>
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
				?><form action="?page=pengaturan_akses_ortu&mode=update" method="post"><?php 
			}else{
				?><form action="?page=pengaturan_akses_ortu&mode=input" method="post"><?php
			}
			?>
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    
					<tr>
                      <th valign="top">Orang Tua</th>
                      <td><select name="id_ortu"  class="styledselect_form_1">
                      <?php
					  $ortu=mysqli_query($link,"select * from data_orangtua order by nama_orangtua asc");
					  while($row=mysqli_fetch_array($ortu)){
					  ?>
                          <option value="<?php echo $row['id_orangtua'];?>" <?php if($row['id_orangtua']==$id_ortu){ echo 'selected';}?>><?php echo $row['nama_orangtua'];?></option>
					  <?php
					  }
					  ?>                          
                      </select>
                      </td>
                      <td></td>
                    </tr>
					
					
					<tr>
                      <th valign="top">Siswa</th>
                      <td><select name="id_siswa"  class="styledselect_form_1">
                      <?php
					  $siswa=mysqli_query($link,"select * from data_siswa order by nama_siswa asc");
					  while($row4=mysqli_fetch_array($siswa)){
					  ?>
                          <option value="<?php echo $row4['id_siswa'];?>" <?php if($row4['id_siswa']==$id_siswa){ echo 'selected';}?>><?php echo $row4['nama_siswa'];?> [ <?php echo $row4['nis'];?> ] </option>
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
					  		<input type="hidden" name="id_akses" value="<?php echo $_GET['id_akses'];?>">
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

			<p><em>*  1 Orang Tua bisa mengakses lebih dari satu siswa <br />
		</em> </p>           
			<p>&nbsp;</p>
			  <!--  start product-table ..................................................................................... -->
        <form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="7%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">Photo Ortu</a></th>
			<th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Ortu</a></th>
			<th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">Status</a></th>
            <th width="13%" class="table-header-repeat line-left minwidth-1"><a href="">Telpon</a></th>
			<th width="13%" class="table-header-repeat line-left minwidth-1"><a href="">Photo Siswa</a></th>
            <th width="16%" class="table-header-repeat line-left minwidth-1"><a href="">Nama siswa</a></th>
            <th width="13%" class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
            <th width="8%" class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
		$view=mysqli_query($link,"select orangtua.photo as portu,siswa.photo as posiswa,telpon_orangtua,nis,nama_orangtua,nama_siswa,status_keluarga,id_akses from tbl_akses_ortu akses, data_orangtua orangtua, data_siswa siswa where akses.id_siswa=siswa.id_siswa and akses.id_orangtua=orangtua.id_orangtua order by id_akses asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
			<td>
				<?php 
				$portu=$row['portu'];
				if(empty($portu)){
					$photo_ortu='nopic.jpg';
				}else{
					$photo_ortu=$portu;
				}
				?>
				<div align="center"><img src="./photo_ortu/<?php echo $photo_ortu;?>" height="101" width="83">
			      </div></td>
            <td><?php echo $row['nama_orangtua'];?></td>
			<td align="center"><?php echo ucwords($row['status_keluarga']);?></td>
            <td><?php echo $row['telpon_orangtua'];?></td>
			<td>
				<?php 
				$posiswa=$row['posiswa'];
				if(empty($posiswa)){
					$photo_siswa='nopic.jpg';
				}else{
					$photo_siswa=$posiswa;
				}
				?>
				<div align="center"><img src="./photo_siswa/<?php echo $photo_siswa;?>" height="101" width="83">
			      </div></td>
            <td><?php echo $row['nama_siswa'];?></td>
            <td><?php echo $row['nis'];?></td>
            <td class="options-width">
            <a href="?page=pengaturan_akses_ortu&mode=delete&id_akses=<?php echo $row['id_akses'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=pengaturan_akses_ortu&mode=edit&id_akses=<?php echo $row['id_akses'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
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
