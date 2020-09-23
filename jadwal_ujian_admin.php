<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if($_GET['mode']=='input'){
	$id_ruang_kelas=htmlentities($_POST['id_ruang_kelas']);
	$id_matapelajaran=htmlentities($_POST['id_matapelajaran']);
	$id_kelas=htmlentities($_POST['id_kelas']);
	
	$tanggal=$_POST['tanggal'];
	$jam=$_POST['jam'];
	
	$cek_query=mysqli_query($link,"select * from tbl_jadwal_ujian where id_ruang_kelas='$id_ruang_kelas' and id_matapelajaran='$id_matapelajaran' and id_kelas='$id_kelas' and tanggal='$tanggal' and jam='$jam'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){	
		?><script language="javascript">document.location.href="?page=jadwal_ujian_admin&status=4";</script><?php
	}else{
		$query=mysqli_query($link,"insert into tbl_jadwal_ujian values('','$id_matapelajaran','$id_kelas','$id_ruang_kelas','$tanggal','$jam','$id_periode')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=jadwal_ujian_admin&status=1";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){

	$id_ujian=$_GET['id_ujian'];
	$query=mysqli_query($link,"delete from tbl_jadwal_ujian where id_ujian='$id_ujian'");
	if($query){
		?><script language="javascript">document.location.href="?page=jadwal_ujian_admin&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_ujian=$_POST['id_ujian'];
	
	$id_ruang_kelas=htmlentities($_POST['id_ruang_kelas']);
	$id_matapelajaran=htmlentities($_POST['id_matapelajaran']);
	$id_kelas=htmlentities($_POST['id_kelas']);
	
	$tanggal=htmlentities($_POST['tanggal']);
	$jam=htmlentities($_POST['jam']);
	
	$cek_query=mysqli_query($link,"select * from tbl_jadwal_ujian where id_ruang_kelas='$id_ruang_kelas' and id_matapelajaran='$id_matapelajaran' and id_kelas='$id_kelas' and tanggal='$tanggal' and jam='$jam'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){
		?><script language="javascript">document.location.href="?page=jadwal_ujian_admin&status=0";</script><?php
	}else{	
	
		$query=mysqli_query($link,"update tbl_jadwal_ujian set id_ruang_kelas='$id_ruang_kelas', id_matapelajaran='$id_matapelajaran', id_kelas='$id_kelas', tanggal='$tanggal', jam='$jam' where id_ujian='$id_ujian'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=jadwal_ujian_admin&status=3";</script><?php
		}else{
			echo mysqli_error();
		}
	}
}

if($_GET['mode']=='edit'){
	$id_ujian=$_GET['id_ujian'];
	$edit=mysqli_query($link,"select * from tbl_jadwal_ujian where id_ujian='$id_ujian'");

	$data=mysqli_fetch_array($edit);
	$id_ruang_kelas=$data['id_ruang_kelas'];
	$id_matapelajaran=$data['id_matapelajaran'];
	$id_kelas=$data['id_kelas'];
	
	$tanggal=$data['tanggal'];
	$jam=$data['jam'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Jadwal Ujian</h1>
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
				?><form action="?page=jadwal_ujian_admin&mode=update" method="post" name="postform"><?php 
			}else{
				?><form action="?page=jadwal_ujian_admin&mode=input" method="post" name="postform"><?php
			}
			?>
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                   
				    <tr>
                      <th valign="top">Mata Pelajaran</th>
                      <td><select name="id_matapelajaran" >

                          <?php
						  $matapelajaran=mysqli_query($link,"select * from setup_matapelajaran order by nama_matapelajaran asc");
						  while($row2=mysqli_fetch_array($matapelajaran)){
						  ?>
							  <option value="<?php echo $row2['id_matapelajaran'];?>" <?php if($row2['id_matapelajaran']==$id_matapelajaran){ echo 'selected';}?>><?php echo $row2['nama_matapelajaran'];?></option>
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
						  while($row3=mysqli_fetch_array($kelas)){
						  ?>
							  <option value="<?php echo $row3['id_kelas'];?>" <?php if($row3['id_kelas']==$id_kelas){ echo 'selected';}?>><?php echo $row3['nama_kelas'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
					
					<tr>
                      <th valign="top">Ruang Kelas</th>
                      <td><select name="id_ruang_kelas"  class="styledselect_form_1">
                          <?php
						  $kelas=mysqli_query($link,"select * from setup_ruang_kelas order by nama_ruang_kelas asc");
						  while($row7=mysqli_fetch_array($kelas)){
						  ?>
							  <option value="<?php echo $row7['id_ruang_kelas'];?>" <?php if($row7['id_ruang_kelas']==$id_ruang_kelas){ echo 'selected';}?>><?php echo $row7['nama_ruang_kelas'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
					
					<tr>
                      <th valign="top">Tanggal</th>
                      <td>
					  <input type="text" name="tanggal" class="inp-form" value="<?php echo $tanggal; ?>">
                      <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
					  </td>
                      <td></td>
                    </tr>
					
					<tr>
                      <th valign="top">Jam</th>
                      <td>
					  <input type="text" name="jam" class="inp-form" value="<?php if(empty($jam)){ echo "00:00:00"; }else{ echo $jam; }?>">
                      </td>
                      <td></td>
                    </tr>
					                    
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_ujian" value="<?php echo $_GET['id_ujian'];?>">
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



		<p><em><br />
		</em></p>           
		<p>&nbsp;</p>
		<!--  start product-table ..................................................................................... -->
        <center>
		<?php
		//************awal paging************//
		$query=mysqli_query($link,"select * from tbl_jadwal_ujian jadwal, setup_kelas kelas, setup_ruang_kelas ruang, setup_matapelajaran matapelajaran where jadwal.id_kelas=kelas.id_kelas and jadwal.id_ruang_kelas=ruang.id_ruang_kelas and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_periode='$id_periode' order by id_ujian asc");
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
			<a href="?page=jadwal_ujian_admin&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
			<?php
			$pages++;
			}
			
		}else{
			$pages=1;
		}
		//**************akhir paging*****************//
		?>
		</center>
		
		</font>
		<?php
		$page=(int)$_GET['halaman'];
		$offset=$page*$entries;
		
		//menampilkan data dengan menggunakan limit sesuai parameter paging yang diberikan
		$result=mysqli_query($link,"select * from tbl_jadwal_ujian jadwal, setup_kelas kelas, setup_ruang_kelas ruang, setup_matapelajaran matapelajaran where jadwal.id_kelas=kelas.id_kelas and jadwal.id_ruang_kelas=ruang.id_ruang_kelas and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_periode='$id_periode' order by matapelajaran.nama_matapelajaran asc limit $offset,$entries"); //output
		?>
		
		
		
		<form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Ruang Kelas</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Tanggal</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Jam</a></th>
			<th class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        <?php
		$no=0;
		while($row=mysqli_fetch_array($result)){
		?>	
		<tr>
            <td><?php echo $offset=$offset+1;?></td>
            <td><?php echo $row['nama_matapelajaran'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
			<td><?php echo $row['nama_ruang_kelas'];?></td>
			<td><?php echo $row['tanggal'];?></td>
			<td><?php echo $row['jam'];?></td>
			<td class="options-width">
			<a href="?page=jadwal_ujian_admin&mode=delete&id_ujian=<?php echo $row['id_ujian'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
			<a href="?page=jadwal_ujian_admin&mode=edit&id_ujian=<?php echo $row['id_ujian'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
			</td>

        </tr>
		<?php
		}
		?>
        </table>
        <!--  end product-table................................... --> 
        </form>		
		
		
        <center>
		<!--  end product-table................................... --> 
		TOTAL DATA : <?php echo $get_pages;?>
        </form>
		</center>
		
        
        
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