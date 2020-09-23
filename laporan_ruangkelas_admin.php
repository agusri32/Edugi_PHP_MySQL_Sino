<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<!--  start page-heading -->
<div id="page-heading">
    <h1>Laporan Kelas Siswa</h1>
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
			<form action="?page=laporan_ruangkelas_admin" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">   
				  
                    <tr>
                      <th valign="top">Kelas</th>
                      <td><select name="id_kelas"  class="styledselect_form_1">
						  <option value="0">-- Pilih Kelas --</option>
                          <?php
						  $kelas=mysqli_query($link,"select * from setup_kelas order by nama_kelas asc");
						  while($row2=mysqli_fetch_array($kelas)){
						  ?>
							  <option value="<?php echo $row2['id_kelas'];?>" <?php if($row2['id_kelas']==$id_kelas){ echo 'selected';}?>><?php echo $row2['nama_kelas'];?></option>
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
			$id_kelas=htmlentities($_POST['id_kelas']);
			
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
		    <p><em>*Sebelum export data ke file excel, silahkan tekan tombol Filter Data    </em></p>
<center>
			<a href="javascript:;"><img src="./images/excel-icon.jpeg" title="Export Data" width="18" height="18" border="0" onClick="window.open('./excel/export_ruangkelas.php?id_kelas=<?php echo $id_kelas;?>','scrollwindow','top=200,left=300,width=800,height=500');"></a>
		</center>
		    
	    <form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="13%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
            <th width="26%" class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
            <th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
            <th width="13%" class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
		$view=mysqli_query($link,"select * from tbl_ruangan ruangan, setup_kelas kelas, data_siswa siswa where ruangan.id_kelas=kelas.id_kelas and ruangan.id_siswa=siswa.id_siswa $filter_kelas order by id_ruangan asc");

		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_siswa'];?></td>
            <td><?php echo $row['nis'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td class="options-width">
            <a href="?page=jadwal_ruangkelas&mode=delete&id_ruangan=<?php echo $row['id_ruangan'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=jadwal_ruangkelas&mode=edit&id_ruangan=<?php echo $row['id_ruangan'];?>" title="Edit" class="icon-5 info-tooltip"></a>                    
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