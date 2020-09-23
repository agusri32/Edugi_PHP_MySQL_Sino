<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if($_GET['mode']=='input'){
	$id_guru=htmlentities($_POST['id_guru']);
	$id_kelas=htmlentities($_POST['id_kelas']);
	
	$cek_query=mysqli_query($link,"select * from setup_walikelas where id_guru='$id_guru' and id_kelas='$id_kelas'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){	
		?><script language="javascript">document.location.href="?page=data_walikelas&status=4";</script><?php
	}else{
		$query=mysqli_query($link,"insert into setup_walikelas values('','$id_kelas','$id_guru')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=data_walikelas&status=1";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_walikelas&status=0";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){

	$id_walikelas=$_GET['id_walikelas'];
	$query=mysqli_query($link,"delete from setup_walikelas where id_walikelas='$id_walikelas'");
	if($query){
		?><script language="javascript">document.location.href="?page=data_walikelas&status=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_walikelas&status=0";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_walikelas=$_POST['id_walikelas'];
	
	$id_guru=htmlentities($_POST['id_guru']);
	$id_kelas=htmlentities($_POST['id_kelas']);
	
	$cek_query=mysqli_query($link,"select * from setup_walikelas where id_guru='$id_guru' and id_kelas='$id_kelas'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){
		?><script language="javascript">document.location.href="?page=data_walikelas&status=0";</script><?php
	}else{	
	
		$query=mysqli_query($link,"update setup_walikelas set id_guru='$id_guru', id_kelas='$id_kelas' where id_walikelas='$id_walikelas'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=data_walikelas&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_walikelas&status=0";</script><?php
		}
	}
}

if($_GET['mode']=='edit'){
	$id_walikelas=$_GET['id_walikelas'];
	$edit=mysqli_query($link,"select * from setup_walikelas where id_walikelas='$id_walikelas'");

	$data=mysqli_fetch_array($edit);
	$id_guru=$data['id_guru'];
	$id_kelas=$data['id_kelas'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Data Wali Kelas </h1>
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
				?><form action="?page=data_walikelas&mode=update" method="post"><?php 
			}else{
				?><form action="?page=data_walikelas&mode=input" method="post"><?php
			}
			?>
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    
					<tr>
                      <th valign="top">Guru</th>
                      <td><select name="id_guru"  class="styledselect_form_1">
                      <?php
					  $ortu=mysqli_query($link,"select * from data_guru order by nama_guru asc");
					  while($row=mysqli_fetch_array($ortu)){
					  ?>
                          <option value="<?php echo $row['id_guru'];?>" <?php if($row['id_guru']==$id_guru){ echo 'selected';}?>><?php echo $row['nama_guru'];?></option>
					  <?php
					  }
					  ?>                          
                      </select>
                      </td>
                      <td></td>
                    </tr>
					
					
					<tr>
                      <th valign="top">Kelas</th>
                      <td><select name="id_kelas"  class="styledselect_form_1">
                      <?php
					  $kelas=mysqli_query($link,"select * from setup_kelas order by nama_kelas asc");
					  while($row4=mysqli_fetch_array($kelas)){
					  ?>
                          <option value="<?php echo $row4['id_kelas'];?>" <?php if($row4['id_kelas']==$id_kelas){ echo 'selected';}?>><?php echo $row4['nama_kelas'];?></option>
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
					  		<input type="hidden" name="id_walikelas" value="<?php echo $_GET['id_walikelas'];?>">
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

		<p><em>		</em> </p>           
			<p>&nbsp;</p>
			  <!--  start product-table ..................................................................................... -->
        <form id="mainform" action="">
        <table border="0" width="71%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="13%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th width="16%" class="table-header-repeat line-left minwidth-1"><a href="">Photo</a></th>
			<th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Guru</a></th>
            <th width="26%" class="table-header-repeat line-left minwidth-1"><a href="">Telpon</a></th>
            <th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Kelas</a></th>
            <th width="13%" class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
		$view=mysqli_query($link,"select * from setup_walikelas walikelas, data_guru guru, setup_kelas kelas where walikelas.id_kelas=kelas.id_kelas and walikelas.id_guru=guru.id_guru order by id_walikelas asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td>
			<?php 
			$photo=$row['photo'];
			if(empty($photo)){
				$photo_guru='nopic.jpg';
			}else{
				$photo_guru=$photo;
			}
			?>
			<img src="./photo_guru/<?php echo $photo_guru;?>" height="101" width="83">			
			</td>
			<td><?php echo $row['nama_guru'];?></td>
            <td><?php echo $row['telpon_guru'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td class="options-width">
            <a href="?page=data_walikelas&mode=delete&id_walikelas=<?php echo $row['id_walikelas'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=data_walikelas&mode=edit&id_walikelas=<?php echo $row['id_walikelas'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
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