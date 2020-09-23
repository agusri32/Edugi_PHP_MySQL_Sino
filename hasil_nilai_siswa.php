<?php 
if($domain!=='ortu'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

		<!--   <strong><script type="text/javascript" src="./js/jquery.js"></script> </strong> jquery chart -->    
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
    <h1>Rekap Nilai</h1>
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

      	<!--  start product-table ..................................................................................... -->
	
    	<?php
		
		$id_siswa=$_GET['id_siswa'];
		$siswa=mysqli_fetch_array(mysqli_query($link,"select siswa.nama_siswa,siswa.photo, siswa.nis, kelas.nama_kelas, kelas.id_kelas from tbl_ruangan ruangan, data_siswa siswa, setup_kelas kelas where ruangan.id_siswa=siswa.id_siswa and ruangan.id_siswa='$id_siswa' and ruangan.id_kelas=kelas.id_kelas"));
		
		$nama_siswa=$siswa['nama_siswa'];
		$photo=$siswa['photo'];
		$nis=$siswa['nis'];
		$nama_kelas=$siswa['nama_kelas'];
		
		$id_kelas=$siswa['id_kelas'];
		$view=mysqli_fetch_array(mysqli_query($link,"select * from setup_walikelas walikelas, data_guru guru, setup_kelas kelas where walikelas.id_kelas='$id_kelas' and walikelas.id_guru=guru.id_guru order by id_walikelas asc"));
		?>
    
		
        <table border="0" width="100%" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
          <th valign="top" colspan="2"><a href="?page=hasil_nilai_home"><font color="#0099FF">Kembali ke menu Utama</font></a></th>
          <td></td>
        </tr>
        <tr>
            <th>
            <?php 
            if(empty($photo)){
                $photo_siswa='nopic.jpg';
            }else{
                $photo_siswa=$photo;
            }
            ?>
            <img src="./photo_siswa/<?php echo $photo_siswa;?>" class="imgBox" height="101" width="83">
            </th>
            <th></th>
		</tr>       
	    <tr>
          <th valign="top">Nama Siswa</th>
          <td><input type="text" class="inp-form" name="nama_siswa" value="<?php echo $nama_siswa;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
         <tr>
          <th valign="top">NIS</th>
          <td><input type="text" class="inp-form" name="nama_siswa" value="<?php echo $nis;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
        <tr>
          <th valign="top">Kelas</th>
          <td><input type="text" class="inp-form" name="nis" value="<?php echo $nama_kelas;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
		<tr>
          <th valign="top">Walikelas</th>
          <td><input type="text" class="inp-form" name="nama_siswa" value="<?php echo $view['nama_guru'];?>" disabled="disabled"/></td>
          <td></td>
        </tr>
      </table>
      <br />
	 
	  	<center>
		<a href="javascript:;"  title="Cetak Nilai ke File PDF"><img src="./images/pdf-icon.jpeg" width="18" height="18" border="0" onClick="window.open('./pdf/export_pdf_semester.php?id_siswa=<?php echo $id_siswa;?>&nama_siswa=<?php echo $nama_siswa;?>&nis=<?php echo $nis;?>&semester=<?php echo $c;?>&photo=<?php echo $logo;?>','scrollwindow','top=200,left=300,width=800,height=500');"></a>
		</center>
      
        <form id="mainform" action="home.php?page=input_nilai_siswa" method="post">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
            <th width="20%" class="table-header-repeat line-left minwidth-1"><a href="">Mata Pelajaran</a></th>
            <th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nilai Tugas</a></th>
			<th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nilai UTS</a></th>
			<th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nilai UAS</a></th>
			<th width="10%" class="table-header-repeat line-left minwidth-1"><a href=""><font color="#00FF33">KUMULATIF</font></a></th>
			<th width="10%" class="table-header-repeat line-left minwidth-1"><a href=""><font color="#FFCC00">BOBOT</font></a></th>
        </tr>
        
        
        <?php
		$view=mysqli_query($link,"SELECT nama_matapelajaran, nilai_tugas, nilai_uts, nilai_uas FROM tbl_nilai nilai, setup_matapelajaran matapelajaran WHERE nilai.id_siswa='$id_siswa' and nilai.id_matapelajaran=matapelajaran.id_matapelajaran order by matapelajaran.nama_matapelajaran asc");
		$view_diagram=mysqli_query($link,"SELECT nama_matapelajaran, nilai_tugas, nilai_uts, nilai_uas FROM tbl_nilai nilai, setup_matapelajaran matapelajaran WHERE nilai.id_siswa='$id_siswa' and nilai.id_matapelajaran=matapelajaran.id_matapelajaran order by matapelajaran.nama_matapelajaran asc");
				
		$i = 1;
		while($row=mysqli_fetch_array($view)){
			?>
			<tr>
				<td><?php echo $i;?></td>
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
			
			$nilai=$row['nilai_tugas'];
			
			$total=$total+$nilai;
			
		}
		?>
        <tr>
            <td colspan="5" align="center"><b>TOTAL NILAI</b></td>
            <td><?php echo $total;?></td>
			<td></td>
        </tr>
        </table>
        <!--  end product-table................................... --> 
        </form>
		
		<div class="clear"></div>
		
		<!-- 3. Add the container -->
		<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
        		
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
	<table id="datatable" style="visibility:hidden">
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
	while($data=mysqli_fetch_array($view_diagram)){
		?>
		<tr>
			<th><?php echo $data['nama_matapelajaran'];?></th>
			<td><?php echo $data['nilai_uas'];?></td>
			<td><?php echo $data['nilai_uts'];?></td>
			<td><?php echo $data['nilai_tugas'];?></td>
		</tr>
		<?php
	}
	?>
	</tbody>
	</table>
