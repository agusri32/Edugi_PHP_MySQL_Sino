<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<!--  start page-heading -->
	<div id="page-heading">
		<h1>Laporan Penilaian</h1>
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
		
			<!--  start table-content  -->
			<div id="table-content">
				
            <form action="?page=laporan_penilaian_admin" method="post">
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
                          <option value="<?php echo $row1['id_guru'];?>"><?php echo $row1['nama_guru'];?> [ <?php echo $row1['nip'];?> ] </option>
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
                      <option value="0">-- Pilih Siswa --</option>
                      <?php
					  $siswa=mysqli_query($link,"select * from data_siswa order by nama_siswa asc");
					  while($row4=mysqli_fetch_array($siswa)){
					  ?>
                          <option value="<?php echo $row4['id_siswa'];?>"><?php echo $row4['nama_siswa'];?> [ <?php echo $row4['nis'];?> ] </option>
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
                      <th valign="top">Mata Pelajaran</th>
                      <td><select name="id_matapelajaran"  class="styledselect_form_1">
					  <option value="0">-- Pilih Mata Pelajaran --</option>
                          <?php
						  $matapelajaran=mysqli_query($link,"select * from setup_matapelajaran order by nama_matapelajaran asc");
						  while($row2=mysqli_fetch_array($matapelajaran)){
						  ?>
							  <option value="<?php echo $row2['id_matapelajaran'];?>"><?php echo $row2['nama_matapelajaran'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
                        
						                
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top"><input type="submit" name="submit" value="Filter Data" class="form-filter" />
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
			
				<p>
				  <?php
				if(isset($_POST['submit'])){
					
					$id_guru=htmlentities($_POST['id_guru']);
					$id_siswa=htmlentities($_POST['id_siswa']);
					$id_kelas=htmlentities($_POST['id_kelas']);
					$id_matapelajaran=htmlentities($_POST['id_matapelajaran']);
					
					
					
					if($id_guru!=="0"){
						$filter_guru="and nilai.id_guru='$id_guru'";
					}else{
						$filter_guru="";
					}
					
					if($id_siswa!=="0"){
						$filter_siswa="and nilai.id_siswa='$id_siswa'";
					}else{
						$filter_siswa="";
					}
					
					if($id_kelas!=="0"){
						$filter_kelas="and ruangan.id_kelas='$id_kelas'";
					}else{
						$filter_kelas="";
					}
					
					if($id_matapelajaran!=="0"){
						$filter_matapelajaran="and nilai.id_matapelajaran='$id_matapelajaran'";
					}else{
						$filter_matapelajaran="";
					}
					
				}else{
					unset($_POST['submit']);
				}
				?>
			  </p>
				<p><em>*Sebelum export data ke file excel, silahkan tekan tombol Filter Data </em> </p>
			  <center>
			<a href="javascript:;"><img src="./images/excel-icon.jpeg" title="Export Data" width="18" height="18" border="0" onClick="window.open('./excel/export_nilaisiswa.php?id_guru=<?php echo $id_guru;?>&id_siswa=<?php echo $id_siswa;?>&id_kelas=<?php echo $id_kelas;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>','scrollwindow','top=200,left=300,width=800,height=500');"></a>
			</center>
            
            
				<!--  start product-table ..................................................................................... -->
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                  	<th width="4%" class="table-header-options line-left"><a href="">Nomor</a></th>
					<th width="11%" class="table-header-repeat line-left minwidth-1"><a href="">Siswa</a></th>
				  	<th width="7%" class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
					<th width="5%" class="table-header-options line-left"><a href="">Kelas</a></th>
                    <th width="12%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Guru</a></th>
					<th width="6%" class="table-header-repeat line-left minwidth-1"><a href="">NIP</a></th>
				  	<th width="15%" class="table-header-repeat line-left"><a href="">Mata Pelajaran</a></th>
				  	<th width="20%" class="table-header-options line-left"><a href=""> Tugas</a></th>
					<th width="6%" class="table-header-options line-left"><a href=""> UTS</a></th>
					<th width="13%" class="table-header-options line-left"><a href=""> UAS</a></th>
				</tr>
                
                <?php
				$view=mysqli_query($link,"SELECT siswa.nama_siswa, siswa.nis, guru.nama_guru, guru.nip, ruangan.id_kelas, matapelajaran.nama_matapelajaran, nilai.nilai_tugas, nilai.nilai_uts, nilai.nilai_uas FROM tbl_nilai nilai, data_siswa siswa, setup_matapelajaran matapelajaran, tbl_ruangan ruangan, data_guru guru WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_matapelajaran=matapelajaran.id_matapelajaran and nilai.id_guru=guru.id_guru and ruangan.id_siswa=siswa.id_siswa $filter_guru $filter_siswa $filter_matapelajaran $filter_kelas order by siswa.nama_siswa asc");

				$i = 1;
				while($row=mysqli_fetch_array($view)){
					$id_kelas=$row['id_kelas'];
					$kelas=mysqli_fetch_array(mysqli_query($link,"select * from setup_kelas where id_kelas='$id_kelas'"));
					?>
					<tr>
                        <td><?php echo $i;?></td>
						<td><?php echo $row['nama_siswa'];?></td>
						<td><?php echo $row['nis'];?></td>
						<td><?php echo $kelas['nama_kelas'];?></td>
                        <td><?php echo $row['nama_guru'];?></td>
						<td><?php echo $row['nip'];?></td>
                        <td><?php echo $row['nama_matapelajaran'];?></td>
                        <td><?php echo $row['nilai_tugas'];?></td>
						<td><?php echo $row['nilai_uts'];?></td>
						<td><?php echo $row['nilai_uas'];?></td>
					</tr>
					<?php
					$i++;
				}
					$jumSis = $i-1;
				?>
                
				</table>
				<!--  end product-table................................... --> 

			</div>
			<!--  end content-table  -->
		
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
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>