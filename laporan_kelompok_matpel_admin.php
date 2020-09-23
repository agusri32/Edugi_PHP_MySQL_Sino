<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<!--  start page-heading -->
<div id="page-heading">
    <h1>Laporan Mata Pelajaran</h1>
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
			<form action="?page=laporan_kelompok_matpel_admin" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">   
				  
                  <tr>
                      <th valign="top">Kelompok MatPel</th>
                      <td><select name="id_kelompok" class="styledselect_form_1">
                      <option value="0">-- Pilih Kelompok Matpel--</option>
                      <?php
					  $kelompok=mysqli_query($link,"select * from setup_kelompok_matpel order by nama_kelompok asc");
					  while($row1=mysqli_fetch_array($kelompok)){
					  ?>
                    	<option value="<?php echo $row1['id_kelompok'];?>" <?php if($row1['id_kelompok']==$id_kelompok){ echo 'selected';}?>><?php echo $row1['nama_kelompok'];?>	</option>
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
		
			$id_kelompok=$_POST['id_kelompok'];
			
			if($id_kelompok!=="0"){
				$filter_kelompok="where id_kelompok='$id_kelompok'";
			}else{
				$filter_kelompok="";
			}
			
		}else{
			unset($_POST['submit']);
		}
		?>
	    </p>
		<?php
		//************awal paging************//
		$query=mysqli_query($link,"select * from setup_matapelajaran $filter_kelompok order by nama_matapelajaran asc");
		
		?>

      	<!--  start product-table ..................................................................................... -->
        <form id="mainform" action="">
        <table border="0" width="80%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Kelompok</a></th>
            <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Mata Pelajaran</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Kode Mata Pelajaran</a></th>
			<!--
			<th class="table-header-repeat line-left minwidth-1"><a href="">SKS</a></th>
			<th class="table-header-repeat line-left minwidth-1"><a href="">Semester</a></th>
			-->
            <th class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php		
		$no=0;
		while($row=mysqli_fetch_array($query)){
		?>	
		<tr>
            <td><?php echo $offset=$offset+1;?></td>
            <td><?php 
			$id_kel=$row['id_kelompok'];
			$dat=mysqli_fetch_array(mysqli_query($link,"select * from setup_kelompok_matpel where id_kelompok='$id_kel'"));
			echo $dat['nama_kelompok'];
			?></td>
            <td><?php echo $row['nama_matapelajaran'];?></td>
			<td><?php echo $row['kode_matapelajaran'];?></td>
			<!--
			<td><?php //echo $row['sks'];?></td>
			<td><?php //echo $row['semester'];?></td>
			-->
            <td class="options-width">
            <a href="?page=setup_matapelajaran&mode=delete&id_matapelajaran=<?php echo $row['id_matapelajaran'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=setup_matapelajaran&mode=edit&id_matapelajaran=<?php echo $row['id_matapelajaran'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
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