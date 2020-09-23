<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
		<!--  <script type="text/javascript" src="./js/jquery.js"></script>  jquery chart -->    
		<!-- 1. Add these JavaScript inclusions in the head of your page -->
		
		
		<script type="text/javascript" src="./js/highcharts.js"></script>
		
		<!-- 1a) Optional: add a theme file -->
		<!-- <script type="text/javascript" src="../js/themes/gray.js"></script> -->
		
		<!-- 1b) Optional: the exporting module -->
		<script type="text/javascript" src="./js/modules/exporting.js"></script>
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		<script type="text/javascript">
			/**
			 * Visualize an HTML table using Highcharts. The top (horizontal) header 
			 * is used for series names, and the left (vertical) header is used 
			 * for category names. This function is based on jQuery.
			 * @param {Object} table The reference to the HTML table to visualize
			 * @param {Object} options Highcharts options
			 */
			Highcharts.visualize = function(table, options) {
				// the categories
				options.xAxis.categories = [];
				$('tbody th', table).each( function(i) {
					options.xAxis.categories.push(this.innerHTML);
				});
				
				// the data series
				options.series = [];
				$('tr', table).each( function(i) {
					var tr = this;
					$('th, td', tr).each( function(j) {
						if (j > 0) { // skip first column
							if (i == 0) { // get the name and init the series
								options.series[j - 1] = { 
									name: this.innerHTML,
									data: []
								};
							} else { // add values
								options.series[j - 1].data.push(parseFloat(this.innerHTML));
							}
						}
					});
				});
				
				var chart = new Highcharts.Chart(options);
			}
				
			// On document ready, call visualize on the datatable.
			$(document).ready(function() {			
				var table = document.getElementById('datatable'),
				options = {
					   chart: {
					      renderTo: 'container',
					      defaultSeriesType: 'column'
					   },
					   title: {
					      text: 'Diagram Batang Nilai siswa'
					   },
					   xAxis: {
					   },
					   yAxis: {
					      title: {
					         text: 'Nilai'
					      }
					   },
					   tooltip: {
					      formatter: function() {
					         return '<b>'+ this.series.name +'</b><br/>'+
					            this.y +' '+ this.x.toLowerCase();
					      }
					   }
					};
				
			      					
				Highcharts.visualize(table, options);
			});
		</script>


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
			
			<form action="?page=laporan_penilaian" method="post">
 	        <table border="0" width="80%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">   
                    <tr>
                      <th valign="top">Mata Pelajaran</th>
                      <td>
					  	<select name="id_matapelajaran"  class="styledselect_form_1">
						  <option value="0">-- Pilih Mata Pelajaran --</option>
                          <?php
						  $id_guru=$_SESSION['id_guru'];
						  $query=mysqli_query($link,"select distinct matapelajaran.id_matapelajaran,matapelajaran.nama_matapelajaran from tbl_jadwal_mengajar jadwal, setup_kelas kelas, setup_matapelajaran matapelajaran where jadwal.id_kelas=kelas.id_kelas and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_guru='$id_guru' order by id_jadwal asc");
						  while($row2=mysqli_fetch_array($query)){
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
                      <th valign="top">Kelas</th>
                      <td>
					  	<select name="id_kelas"  class="styledselect_form_1">
						  <option value="0">-- Pilih Kelas --</option>
                          <?php
						  $id_guru=$_SESSION['id_guru'];
						  $query=mysqli_query($link,"select distinct kelas.id_kelas,kelas.nama_kelas from tbl_jadwal_mengajar jadwal, setup_kelas kelas, setup_matapelajaran matapelajaran where jadwal.id_kelas=kelas.id_kelas and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_guru='$id_guru' order by id_jadwal asc");
						  while($row2=mysqli_fetch_array($query)){
						  ?>
							  <option value="<?php echo $row2['id_kelas'];?>"><?php echo $row2['nama_kelas'];?></option>
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
			<p>
			  <?php
			if(isset($_POST['submit'])){
				$id_matapelajaran=htmlentities($_POST['id_matapelajaran']);
				$id_kelas=htmlentities($_POST['id_kelas']);
				
				if($id_matapelajaran!=="0"){
					$filter_matapelajaran="and nilai.id_matapelajaran='$id_matapelajaran'";
				}else{
					$filter_matapelajaran="";
				}
				
				if($id_kelas!=="0"){
					$filter_kelas="and ruangan.id_kelas='$id_kelas'";
				}else{
					$filter_kelas="";
				}
			}else{
				unset($_POST['submit']);
			}
			?>
		  </p>
			<p><em>*Sebelum export data ke file excel, silahkan tekan tombol Filter Data </em></p>
		  <center>
			<a href="javascript:;"><img src="./images/excel-icon.jpeg" width="18" height="18" border="0" onClick="window.open('./excel/export_guru_nilaisiswa.php?id_guru=<?php echo $id_guru;?>&id_matapelajaran=<?php echo $id_matapelajaran;?>&id_kelas=<?php echo $id_kelas;?>&id_periode=<?php echo $id_periode;?>','scrollwindow','top=200,left=300,width=800,height=500');"></a>
			</center>
			
			
			<!--  start table-content  -->
			<div id="table-content">
			
				<!--  start product-table ..................................................................................... -->
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                    <th width="4%" class="table-header-options line-left"><a href="" >Nomor</a></th>
					<th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a>	</th>
					<th width="15%" class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
					<th width="10%" class="table-header-repeat line-left"><a href="">Kelas</a></th>
					<th width="32%" class="table-header-repeat line-left"><a href="">Mata Pelajaran</a></th>
				    <th width="12%" class="table-header-options line-left"><a href="">Tugas</a></th>
					<th width="12%" class="table-header-options line-left"><a href="">UTS</a></th>
					<th width="12%" class="table-header-options line-left"><a href="">UAS</a></th>
					<th width="10%" class="table-header-repeat line-left minwidth-1"><a href=""><font color="#00FF33">KUMULATIF</font></a></th>
					<th width="10%" class="table-header-repeat line-left minwidth-1"><a href=""><font color="#FFCC00">GRADE</font></a></th>

				</tr>
                
                <?php
				$view=mysqli_query($link,"SELECT * FROM tbl_nilai nilai, data_siswa siswa, setup_matapelajaran matapelajaran, tbl_ruangan ruangan WHERE nilai.id_siswa=ruangan.id_siswa and nilai.id_siswa=siswa.id_siswa and nilai.id_matapelajaran=matapelajaran.id_matapelajaran and nilai.id_guru='$id_guru' and nilai.id_periode='$id_periode' $filter_matapelajaran $filter_kelas order by siswa.nama_siswa asc");
					
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
                        <td><?php echo $row['nama_matapelajaran'];?></td>
                        <td><?php echo $tugas=$row['nilai_tugas'];?></td>
						<td><?php echo $uts=$row['nilai_uts'];?></td>
						<td><?php echo $uas=$row['nilai_uas'];?></td>
						<td><?php echo $total=round(($tugas+$uts+$uas)/3);?></td>
						<td>
						<?php
						if($total>=80 && $total<=100){
							echo "A";
						}
						
						if($total>=68 && $total<=79){
							echo "B";
						}
						
						if($total>=50 && $total<=67){
							echo "C";
						}
						
						if($total>=38 && $total<=49){
							echo "D";
						}
						
						if($total>=0 && $total<=37){
							echo "E";
						}
						?>				
						</td>

					</tr>
					<?php
					$i++;
				}
					$jumSis = $i-1;
				?>
				</table>
				<!--  end product-table................................... --> 
				
				<!-- 3. Add the container -->
				<!--
				<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
				-->

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
	
	
	<!--untuk menampilkan di chart-->
	<!--
	<table id="datatable" style="visibility:hidden ">
		<thead>
			<tr>
				<th></th>
				<th>Tugas</th>
				<th>UTS</th>
				<th>UAS</th>
			</tr>
		</thead>
		<tbody>
		<?php
		/*
		while($data=mysqli_fetch_array($view_diagram)){
			?>
			<tr>
				<th><?php echo $data['nama_siswa'];?></th>
				<td><?php echo $data['nilai_uas'];?></td>
				<td><?php echo $data['nilai_uts'];?></td>
				<td><?php echo $data['nilai_tugas'];?></td>
			</tr>
			<?php
		}
		*/
		?>
		</tbody>
	</table>
	-->
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->
<div class="clear">&nbsp;</div>