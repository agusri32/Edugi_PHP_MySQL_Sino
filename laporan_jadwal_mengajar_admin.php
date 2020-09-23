<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<!--  start page-heading -->
<div id="page-heading">
    <h1>Laporan Jadwal Mengajar </h1>
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
    		    
    		<form action="?page=laporan_jadwal_mengajar_admin" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Guru</th>
                      <td><select name="id_guru"  class="styledselect_form_1">
                      <option value="0">-- Pilih Guru --</option>
                      <?php  
					  $guru=mysqli_query($link,"select * from data_guru order by nama_guru asc");
					  while($row1=mysqli_fetch_array($guru)){
					  ?>
                          <option value="<?php echo $row1['id_guru'];?>" <?php if($row1['id_guru']==$id_guru){ echo 'selected';}?>><?php echo $row1['nama_guru'];?> [ <?php echo $row1['nip'];?> ] </option>
					  <?php
					  }
					  ?>                          
                          
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    
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
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="submit" name="submit" value="Filter Data" class="form-filter" />
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
		
			$id_guru=htmlentities($_POST['id_guru']);
			$id_matapelajaran=htmlentities($_POST['id_matapelajaran']);
			$id_kelas=htmlentities($_POST['id_kelas']);
			
			if($id_guru!=="0"){
				$filter_guru="and jadwal.id_guru='$id_guru'";
			}else{
				$filter_guru="";
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
	   ?>
	    </p>
			  <p><em>*Sebelum export data ke file excel, silahkan tekan tombol Filter Data </em> </p>
	    <center>
		<a href="javascript:;"><img src="./images/excel-icon.jpeg" title="Export Data" width="18" height="18" border="0" onClick="window.open('./excel/export_jadwalmengajar.php?id_guru=<?php echo $id_guru;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>&id_kelas=<?php echo $id_kelas;?>','scrollwindow','top=200,left=300,width=800,height=500');"></a>
		</center>
	   
	    <form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Guru</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">NIP</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Periode</a></th>
            <th class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
		$view=mysqli_query($link,"select id_jadwal,nama_guru,nip,nama_matapelajaran,nama_kelas,tahun_ajaran, periode.semester from tbl_jadwal_mengajar jadwal, setup_kelas kelas, setup_periode periode, setup_matapelajaran matapelajaran, data_guru guru where jadwal.id_kelas=kelas.id_kelas and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_guru=guru.id_guru and jadwal.id_periode=periode.id_periode $filter_guru $filter_siswa $filter_matapelajaran $filter_kelas order by id_jadwal asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_guru'];?></td>
            <td><?php echo $row['nip'];?></td>
            <td><?php echo $row['nama_matapelajaran'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
			<td><?php echo "Thn : ".$row['tahun_ajaran']." - Semester : ".ucwords($row['semester']);?></td>
            <td class="options-width">
            <a href="?page=jadwal_mengajar&mode=delete&id_jadwal=<?php echo $row['id_jadwal'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=jadwal_mengajar&mode=edit&id_jadwal=<?php echo $row['id_jadwal'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
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