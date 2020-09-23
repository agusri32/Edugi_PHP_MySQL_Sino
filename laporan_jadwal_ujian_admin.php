<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Laporan Jadwal Ujian </h1>
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
    
    		<form action="?page=laporan_jadwal_ujian_admin" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    
					<tr>
                      <th valign="top">Mata Pelajaran</th>
                      <td><select name="id_matapelajaran"  class="styledselect_form_1">
						  <option value="0">-- Pilih Mata Pelajaran --</option>
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
						  <option value="0">-- Pilih Kelas --</option>
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
						  <option value="0">-- Pilih Ruang Kelas --</option>
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
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="submit" name="submit" value="" class="form-submit" />
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
		</em> </p>           
			<p>&nbsp;</p>
		    <p>
		      <!--  start product-table ..................................................................................... -->
		      <?php
		if(isset($_POST['submit'])){
			$id_matapelajaran=htmlentities($_POST['id_matapelajaran']);
			$id_kelas=htmlentities($_POST['id_kelas']);
			$id_ruang_kelas=htmlentities($_POST['id_ruang_kelas']);

			
			if($id_ruang_kelas!=="0"){
				$filter_ruang="and jadwal.id_ruang_kelas='$id_ruang_kelas'";
			}else{
				$filter_ruang="";
			}
			
			if($id_matapelajaran!=="0"){
				$filter_matapelajaran="and jadwal.id_matapelajaran='$id_matapelajaran'";
			}else{
				$filter_matapelajaran="";
			}
			
			if($id_kelas!=="0"){
				$filter_kelas="and jadwal.id_kelas='$id_kelas'";
			}else{
				$filter_kelas="";
			}
			
		}else{
			unset($_POST['submit']);
		}
		$result=mysqli_query($link,"select id_ujian,nama_matapelajaran,nama_kelas,nama_ruang_kelas,tanggal,jam,tahun_ajaran,periode.semester from tbl_jadwal_ujian jadwal, setup_kelas kelas, setup_periode periode, setup_ruang_kelas ruang, setup_matapelajaran matapelajaran where jadwal.id_kelas=kelas.id_kelas and jadwal.id_ruang_kelas=ruang.id_ruang_kelas and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_periode=periode.id_periode $filter_ruang $filter_siswa $filter_matapelajaran $filter_kelas order by id_ujian asc"); //output
		?>
        </p>
		    <p><em>*Sebelum export data ke file excel, silahkan tekan tombol Filter Data </em> </p>
	    <center>
		<a href="javascript:;"><img src="./images/excel-icon.jpeg" title="Export Data" width="18" height="18" border="0" onClick="window.open('./excel/export_jadwalujian.php?id_ruang_kelas=<?php echo $id_ruang_kelas;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>&id_kelas=<?php echo $id_kelas;?>','scrollwindow','top=200,left=300,width=800,height=500');"></a>
		</center>
		
		<form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Ruang Kelas</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Tanggal</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Jam</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Periode</a></th>
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
			<td><?php echo "Thn : ".$row['tahun_ajaran']." - Semester : ".ucwords($row['semester']);?></td>
            <td class="options-width">
            <a href="?page=jadwal_ujian&mode=delete&id_ujian=<?php echo $row['id_ujian'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=jadwal_ujian&mode=edit&id_ujian=<?php echo $row['id_ujian'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
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