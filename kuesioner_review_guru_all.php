<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}

if($kuesioner!=='buka'){
	?><script language="javascript">document.location.href="?page=dashboard"</script><?php
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Hasil Kuisioner Penilaian Guru</h1>
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
    
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	  <td><!--  start step-holder -->
		<!--  end step-holder -->
		  <!-- start id-form -->
		  <?php 
			$id_guru=$_GET['id_guru'];
		  ?>

		  <?php
			$guru=mysqli_fetch_array(mysqli_query($link,"select * from data_guru where id_guru='$id_guru'"));
			$nama_guru=$guru['nama_guru'];
			$nip=$guru['nip'];
			$kelamin=$guru['kelamin'];
			$photo=$guru['photo'];
		  ?>
		  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
			<tr>
				<th>
				<?php 
				if(empty($photo)){
					$photo_siswa='nopic.jpg';
				}else{
					$photo_siswa=$photo;
				}
				?>
				<img src="./photo_guru/<?php echo $photo_siswa;?>" class="imgBox" height="101" width="83">
				</th>
				<th></th>
			</tr>

			<tr>
			  <th valign="top">Nama Guru </th>
			  <td>
					<?php echo $nama_guru;?>
			  </td>
			  <td></td>
			</tr>
			
			<tr>
			  <th valign="top">NIP </th>
			  <td>
					<?php echo $nip;?>
			  </td>
			  <td></td>
			</tr>
			
			<tr>
			  <th valign="top">Kelamin </th>
			  <td>
					<?php echo ucwords($kelamin);?>
			  </td>
			  <td></td>
			</tr>
			
			<tr>
			  <th><a href="?page=kuesioner_review_admin"><font color="#0066FF">Back to main</font></a></th>
			  <td valign="top">
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
  

	
		<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
		<tr>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Pertanyaan</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Sangat&nbsp;Baik</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Baik</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Cukup</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Kurang&nbsp;Baik</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Sangat&nbsp;Kurang</a></th>

		</tr>
		
		
		<?php
		$view=mysqli_query($link,"select * from tbl_kuesioner_tanya order by id_tanya asc");
		$jumlah=mysqli_num_rows($view);
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
			$id=$row["id_tanya"];
			$pertanyaan=$row["pertanyaan"];
		?>
		<input type="hidden" name="id[]" value=<?php echo $id; ?>>	
		<input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
		<tr>
			<td align="center"><?php echo $no=$no+1;?></td>
			<td><?php echo $pertanyaan;?>&nbsp;</td>
			
			<?php 
			$query_row5=mysqli_query($link,"select jawaban from tbl_kuesioner where id_tanya='$id' and id_guru='$id_guru' and jawaban='5'");
			$query_row4=mysqli_query($link,"select jawaban from tbl_kuesioner where id_tanya='$id' and id_guru='$id_guru' and jawaban='4'");
			$query_row3=mysqli_query($link,"select jawaban from tbl_kuesioner where id_tanya='$id' and id_guru='$id_guru' and jawaban='3'");
			$query_row2=mysqli_query($link,"select jawaban from tbl_kuesioner where id_tanya='$id' and id_guru='$id_guru' and jawaban='2'");
			$query_row1=mysqli_query($link,"select jawaban from tbl_kuesioner where id_tanya='$id' and id_guru='$id_guru' and jawaban='1'");
			
			$jawaban5=mysqli_num_rows($query_row5);
			$jawaban4=mysqli_num_rows($query_row4);
			$jawaban3=mysqli_num_rows($query_row3);
			$jawaban2=mysqli_num_rows($query_row2);
			$jawaban1=mysqli_num_rows($query_row1);

			?>
			<td align="center"><?php echo $jawaban5;?></td>
			<td align="center"><?php echo $jawaban4;?></td>
			<td align="center"><?php echo $jawaban3;?></td>
			<td align="center"><?php echo $jawaban2;?></td>
			<td align="center"><?php echo $jawaban1;?></td>
		</tr>
		<?php
		}
		?>
		
		</table>
		
	<div class="clear"></div>
     
    </div>
    <!--  end content-table-inner ............................................END  -->
    </td>
    <td id="tbl-b/order-right"></td>
</tr>
<tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
</tr>
</table>